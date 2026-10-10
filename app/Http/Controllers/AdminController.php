<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Bom;
use App\Models\Material;
use App\Models\MotorcycleType;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\StockTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $year = now()->year;
        $monthlyDemand = collect(range(1, 12))->map(fn ($month) => Order::whereYear('created_at', $year)->whereMonth('created_at', $month)->count());

        $thisMonthOrders = Order::whereMonth('created_at', now()->month)->count();
        $thisMonthRevenue = Order::whereIn('status', ['approve', 'process', 'delivery', 'finish'])->whereMonth('created_at', now()->month)->sum('total');

        return view('admin.dashboard', [
            'orderCount' => Order::count(),
            'revenue' => Order::whereIn('status', ['approve', 'process', 'delivery', 'finish'])->sum('total'),
            'thisMonthOrders' => $thisMonthOrders,
            'thisMonthRevenue' => $thisMonthRevenue,
            'customerCount' => \App\Models\User::where('role', 'customer')->count(),
            'pendingPayments' => Order::whereHas('payment', fn ($q) => $q->where('status', 'submitted'))->count(),
            'activeOrders' => Order::whereIn('status', ['approve', 'process', 'delivery'])->count(),
            'finishedStock' => ProductVariant::sum('stock'),
            'productCount' => ProductVariant::count(),
            'materialCount' => Material::count(),
            'monthlyDemand' => $monthlyDemand,
            'monthLabels' => collect(range(1, 12))->map(fn ($month) => Carbon::create($year, $month, 1)->format('M')),
            'lowMaterials' => Material::whereColumn('current_stock', '<=', 'minimum_stock')->get(),
            'recentOrders' => Order::with(['user', 'items.variant'])->latest()->take(7)->get(),
            'topProducts' => ProductVariant::with('product')->withSum('orderItems', 'quantity')->orderByDesc('order_items_sum_quantity')->take(5)->get(),
        ]);
    }

    public function products()
    {
        return view('admin.products', ['products' => Product::with(['variants.motorcycleType'])->latest()->get(), 'types' => MotorcycleType::orderBy('name')->get()]);
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate(['product_name' => ['required', 'string', 'max:120'], 'description' => ['nullable', 'string'], 'motorcycle_type_id' => ['required', 'exists:motorcycle_types,id'], 'variant_name' => ['required', 'string', 'max:120'], 'size' => ['required', 'in:Standar,Jumbo'], 'price' => ['required', 'integer', 'min:0'], 'stock' => ['required', 'integer', 'min:0']]);
        DB::transaction(function () use ($data) {
            $product = Product::create(['name' => $data['product_name'], 'description' => $data['description'] ?? null]);
            $product->variants()->create(collect($data)->only(['motorcycle_type_id', 'variant_name', 'size', 'price', 'stock'])->mapWithKeys(fn ($v, $k) => [$k === 'variant_name' ? 'name' : $k => $v])->all());
        });
        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function updateVariant(Request $request, ProductVariant $variant)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120'], 'price' => ['required', 'integer', 'min:0'], 'stock' => ['required', 'integer', 'min:0'], 'size' => ['required', 'in:Standar,Jumbo']]);
        $difference = $data['stock'] - $variant->stock;
        $variant->update($data);
        if ($difference !== 0) StockTransaction::create(['product_variant_id' => $variant->id, 'type' => $difference > 0 ? 'in' : 'out', 'quantity' => abs($difference), 'reference_type' => 'manual', 'notes' => 'Penyesuaian stok produk']);
        return back()->with('success', 'Variasi produk diperbarui.');
    }

    public function materials()
    {
        return view('admin.materials', ['materials' => Material::latest()->get(), 'transactions' => StockTransaction::with(['material', 'variant'])->latest()->take(20)->get()]);
    }

    public function storeMaterial(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120'], 'unit' => ['required', 'string', 'max:30'], 'current_stock' => ['required', 'numeric', 'min:0'], 'minimum_stock' => ['required', 'numeric', 'min:0'], 'material_cost' => ['required', 'integer', 'min:0']]);
        $material = Material::create($data);
        if ($material->current_stock > 0) StockTransaction::create(['material_id' => $material->id, 'type' => 'in', 'quantity' => $material->current_stock, 'reference_type' => 'manual', 'notes' => 'Stok awal material']);
        return back()->with('success', 'Material berhasil ditambahkan.');
    }

    public function adjustMaterial(Request $request, Material $material)
    {
        $data = $request->validate(['type' => ['required', 'in:in,out'], 'quantity' => ['required', 'numeric', 'min:0.01'], 'notes' => ['nullable', 'string']]);
        if ($data['type'] === 'out' && $material->current_stock < $data['quantity']) return back()->withErrors(['quantity' => 'Stok material tidak mencukupi.']);
        $data['type'] === 'in' ? $material->increment('current_stock', $data['quantity']) : $material->decrement('current_stock', $data['quantity']);
        StockTransaction::create(['material_id' => $material->id, 'type' => $data['type'], 'quantity' => $data['quantity'], 'reference_type' => 'manual', 'notes' => $data['notes'] ?? null]);
        return back()->with('success', 'Stok material diperbarui.');
    }

    public function bom(ProductVariant $variant)
    {
        $variant->load('product', 'motorcycleType', 'bom.items.material');
        return view('admin.bom', ['variant' => $variant, 'materials' => Material::orderBy('name')->get()]);
    }

    public function storeBom(Request $request, ProductVariant $variant)
    {
        $data = $request->validate(['material_id' => ['required', 'exists:materials,id'], 'quantity' => ['required', 'numeric', 'min:0.01'], 'unit' => ['required', 'string', 'max:30']]);
        $bom = Bom::firstOrCreate(['product_variant_id' => $variant->id]);
        $material = Material::findOrFail($data['material_id']);
        $bom->items()->updateOrCreate(['material_id' => $material->id], $data + ['material_cost' => $material->material_cost]);
        return back()->with('success', 'Komponen BOM disimpan.');
    }

    public function orders()
    {
        return view('admin.orders', ['orders' => Order::with(['user', 'payment'])->latest()->paginate(15)]);
    }

    public function reports(Request $request)
    {
        $orders = Order::with(['user', 'items.variant.product'])->when($request->from, fn ($q, $date) => $q->whereDate('created_at', '>=', $date))->when($request->to, fn ($q, $date) => $q->whereDate('created_at', '<=', $date))->latest()->get();
        $transactions = StockTransaction::with(['material', 'variant'])->latest()->take(100)->get();
        $materialCost = $orders->sum(fn ($order) => $order->items->where('item_type', 'material')->sum(fn ($item) => $item->variant->bom?->items->sum(fn ($bomItem) => $bomItem->quantity * $bomItem->material_cost) * $item->quantity));
        $profit = $orders->whereIn('status', ['approve', 'process', 'delivery', 'finish'])->sum('subtotal') - $materialCost;
        return view('admin.reports', compact('orders', 'transactions', 'materialCost', 'profit'));
    }

    public function exportSales()
    {
        $orders = Order::with(['user', 'items.variant'])->latest()->get();
        return response()->streamDownload(function () use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Order', 'Customer', 'Produk', 'Jumlah', 'Harga', 'Status', 'Total', 'Tanggal']);
            foreach ($orders as $order) foreach ($order->items as $item) fputcsv($handle, [$order->order_number, $order->user->name, $item->variant->name, $item->quantity, $item->unit_price, $order->status, $order->total, $order->created_at->format('Y-m-d')]);
            fclose($handle);
        }, 'stalltech-sales-' . now()->format('Ymd') . '.csv', ['Content-Type' => 'text/csv']);
    }

    public function exportExcel()
    {
        $orders = Order::with(['user', 'items.variant'])->latest()->get();
        $rows = '';
        foreach ($orders as $order) foreach ($order->items as $item) {
            $rows .= '<tr><td>' . e($order->order_number) . '</td><td>' . e($order->user->name) . '</td><td>' . e($item->variant->name) . '</td><td>' . $item->quantity . '</td><td>' . $item->unit_price . '</td><td>' . e($order->status) . '</td><td>' . $order->total . '</td></tr>';
        }
        $html = '<table><thead><tr><th>Order</th><th>Customer</th><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Status</th><th>Total</th></tr></thead><tbody>' . $rows . '</tbody></table>';
        return response($html, 200, ['Content-Type' => 'application/vnd.ms-excel', 'Content-Disposition' => 'attachment; filename="stalltech-sales-' . now()->format('Ymd') . '.xls"']);
    }
}
