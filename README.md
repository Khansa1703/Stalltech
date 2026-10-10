# Stalltech Management System

MVP aplikasi Laravel untuk e-commerce jok motor dan operasional inventory Stalltech.

## Modul yang tersedia

- Authentication customer dan Owner dengan role-based authorization.
- Katalog berdasarkan jenis motor, keranjang, checkout, dan ongkos kirim.
- Transfer manual dengan upload bukti pembayaran dan verifikasi Owner.
- Order workflow: Pending, Approve, Process, Delivery, Finish, dan Cancel.
- Stok produk jadi, material, riwayat transaksi, minimum stock alert, dan BOM.
- Pengurangan stok produk dan material BOM otomatis saat pembayaran disetujui.
- Dashboard Owner, notifikasi, laporan sales/inventory/profit, dan export CSV.

## Menjalankan project

1. Pastikan MySQL aktif dan database `stalltech` tersedia.
2. Sesuaikan koneksi database di `.env`.
3. Jalankan migration dan seed demo:

   ```bash
   php artisan migrate --seed
   php artisan storage:link
   npm install
   npm run build
   php artisan serve
   ```

4. Buka `http://127.0.0.1:8000`.

## Akun demo

- Owner: `owner@stalltech.test` / `password`
- Customer: `customer@stalltech.test` / `password`

## Pengujian

```bash
php artisan test
```

Catatan: test bawaan tidak memakai SQLite karena driver SQLite pada PHP lokal harus tersedia untuk pengujian database.

## Import BOM Excel

File BOM CHMP dapat diimport dengan command berikut:

```bash
php artisan bom:import "C:\Users\Khansa\Documents\Stalltech\Billofmaterial-stalltech.xlsx"
```

Import membuat produk BOM nonaktif dari storefront, variasi Standar/Jumbo untuk jenis motor yang sesuai, material roll, serta komponen jasa potong. Import bersifat idempotent sehingga aman dijalankan ulang.
