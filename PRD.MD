# PRODUCT REQUIREMENTS DOCUMENT (PRD)

## Stalltech E-Commerce & Operational Management System

**Versi:** 1.0
**Tanggal:** 3 Oktober 2026
**Status:** Draft untuk Pengembangan
**Produk:** Stalltech Management System
**Platform:** Web Application
**Backend:** Laravel
**Database:** MySQL
**Aktor:** Owner/Admin dan Customer

---

# 1. Product Overview

## 1.1 Nama Produk

**Stalltech Management System**

Stalltech Management System adalah aplikasi berbasis web yang dirancang untuk mendukung kegiatan penjualan produk jok motor melalui e-commerce sekaligus membantu pengelolaan operasional IKM Stalltech.

Sistem mengintegrasikan proses katalog produk, pemilihan produk berdasarkan jenis motor, checkout, pembayaran transfer manual, verifikasi pembayaran, pengelolaan pesanan, pengelolaan stok produk jadi dan bahan, Bill of Materials (BOM), dashboard, notifikasi, serta laporan bisnis.

## 1.2 Latar Belakang

Stalltech membutuhkan sistem informasi yang dapat mendukung proses penjualan produk jok motor secara online sekaligus membantu pencatatan operasional. Salah satu kebutuhan utama adalah tersedianya e-commerce karena proses penjualan perlu dilakukan melalui media digital yang terintegrasi dengan pengelolaan pesanan dan stok.

Selain penjualan, pengelolaan stok bahan dan produk jadi perlu dilakukan secara lebih terstruktur. Sistem juga membutuhkan pencatatan BOM agar kebutuhan material setiap produk dapat diketahui dan digunakan sebagai dasar otomatisasi pengurangan stok.

Berdasarkan kebutuhan tersebut, Stalltech Management System dikembangkan sebagai sistem terintegrasi yang menghubungkan proses penjualan dengan pengelolaan operasional.

---

# 2. Problem Statement

## 2.1 Masalah Utama

Stalltech membutuhkan sistem yang dapat mengintegrasikan aktivitas e-commerce dengan pencatatan operasional IKM.

Permasalahan yang menjadi dasar pengembangan sistem meliputi:

1. Belum tersedianya e-commerce khusus untuk penjualan produk jok motor Stalltech.
2. Proses pemesanan perlu dilakukan melalui sistem yang terstruktur.
3. Pencatatan stok produk jadi perlu dikelola secara sistematis.
4. Pencatatan stok bahan/material perlu dilakukan secara terstruktur.
5. Kebutuhan material untuk suatu produk perlu didokumentasikan melalui BOM.
6. Pengurangan stok bahan perlu disesuaikan dengan jumlah produk yang dipesan.
7. Proses verifikasi pembayaran transfer manual perlu didukung sistem.
8. Status pesanan perlu dapat dipantau oleh Owner dan Customer.
9. Owner membutuhkan dashboard untuk memantau aktivitas penjualan dan persediaan.
10. Owner membutuhkan laporan penjualan, stok, dan keuntungan yang dapat diekspor.

---

# 3. Product Goals

Pengembangan Stalltech Management System memiliki tujuan:

### PG-001 — Meningkatkan Penjualan Online

Menyediakan e-commerce yang memungkinkan Customer melihat dan membeli produk jok motor secara online.

### PG-002 — Mempermudah Pemesanan

Menyediakan proses katalog, pemilihan jenis motor, checkout, pembayaran, dan pemantauan pesanan.

### PG-003 — Meningkatkan Pengelolaan Stok

Membantu Owner mengelola stok produk jadi dan bahan secara terstruktur.

### PG-004 — Menerapkan BOM

Menyediakan Bill of Materials untuk mendokumentasikan kebutuhan material setiap produk.

### PG-005 — Mengotomatisasi Pengurangan Stok

Mengurangi stok produk jadi dan material secara otomatis ketika pesanan telah disetujui sesuai aturan BOM.

### PG-006 — Meningkatkan Monitoring Bisnis

Menyediakan dashboard dan laporan untuk membantu Owner memantau penjualan, stok, dan keuntungan.

---

# 4. Product Scope

## 4.1 In Scope

Fitur yang termasuk dalam sistem:

* Authentication
* Customer registration
* Login
* Product management
* Product variant management
* Product catalog
* Motor type selection
* Shopping cart/checkout
* Shipping information
* Manual transfer payment
* Upload payment proof
* Payment verification
* Order management
* Order status
* Finished product inventory
* Raw material inventory
* Bill of Materials (BOM)
* Automatic inventory deduction
* Low stock notification
* Dashboard
* Sales reports
* Inventory reports
* Profit calculation
* Excel export
* CSV export
* Customer order history
* Notification

Ruang lingkup tersebut sesuai dengan SRS yang menetapkan katalog, checkout, pembayaran manual, inventory, BOM, dashboard, notifikasi, dan reporting sebagai bagian dari sistem.

## 4.2 Out of Scope

Fitur berikut tidak termasuk dalam MVP:

* Custom desain jok
* Request ukuran khusus
* Jasa pemasangan
* Pre-order
* Multi-cabang
* Multi-seller marketplace
* Payment gateway otomatis
* Invoice PDF
* Akuntansi lengkap

Batasan tersebut secara eksplisit ditetapkan dalam SRS Stalltech.

---

# 5. Target Users

## 5.1 Owner/Admin

Owner merupakan pengelola utama IKM Stalltech dan sekaligus berperan sebagai Admin sistem.

Owner/Admin membutuhkan sistem untuk:

* Mengelola produk.
* Mengelola variasi produk.
* Mengelola stok produk jadi.
* Mengelola stok bahan.
* Mengelola BOM.
* Memeriksa pembayaran.
* Mengelola pesanan.
* Mengelola pengiriman.
* Melihat dashboard.
* Melihat laporan.
* Mengekspor laporan.
* Menerima notifikasi.

Dalam rancangan sistem, Owner merupakan satu-satunya pengelola perusahaan sekaligus Admin sistem.

## 5.2 Customer

Customer merupakan pengguna yang membeli produk jok motor Stalltech melalui e-commerce.

Customer membutuhkan kemampuan untuk:

* Registrasi.
* Login.
* Melihat katalog.
* Memilih jenis motor.
* Memilih produk.
* Melakukan checkout.
* Memasukkan alamat pengiriman.
* Melakukan pembayaran transfer.
* Mengunggah bukti pembayaran.
* Melihat status pesanan.
* Melihat nomor resi.
* Melihat riwayat pesanan.
* Menerima notifikasi.

---

# 6. User Roles

| Role        | Deskripsi                                         |
| ----------- | ------------------------------------------------- |
| Owner/Admin | Mengelola seluruh operasional sistem Stalltech    |
| Customer    | Melihat dan membeli produk serta memantau pesanan |

Hak akses Owner/Admin dan Customer harus dibedakan. Customer tidak dapat mengakses halaman pengelolaan sistem.

---

# 7. Product Features

## 7.1 Authentication

### Tujuan

Mengatur akses pengguna berdasarkan role.

### Fitur

* Registrasi Customer.
* Login Customer.
* Login Owner/Admin.
* Logout.
* Role-based authorization.
* Password hashing.

### Data Registrasi Customer

* Nama
* Email
* Nomor telepon
* Alamat
* Password

Email Customer harus unik dan password disimpan dalam bentuk hashed.

---

# 8. Product Catalog

## 8.1 Product Management

Owner/Admin dapat:

* Menambah produk.
* Melihat produk.
* Mengubah produk.
* Menghapus produk.

## 8.2 Product Variant

Setiap variasi produk memiliki informasi:

* Nama.
* Foto.
* Harga.
* Stok produk jadi.
* Jenis motor.
* Ukuran.
* BOM.

Ukuran produk terdiri dari:

* **Standar:** 46 × 90 cm.
* **Jumbo:** 60 × 100 cm.

Jenis motor digunakan sebagai dasar untuk menentukan ukuran produk yang sesuai.

---

# 9. E-Commerce

## 9.1 Product Browsing

Customer dapat:

1. Membuka katalog.
2. Melihat produk.
3. Memilih jenis motor.
4. Melihat variasi produk.
5. Melihat harga.
6. Melihat informasi stok.

## 9.2 Motor Selection

Customer memilih produk berdasarkan jenis motor.

Sistem menentukan ukuran produk yang sesuai berdasarkan mapping jenis motor.

## 9.3 Cart & Checkout

Customer dapat:

* Memilih produk.
* Menentukan jumlah.
* Menentukan alamat pengiriman.
* Memasukkan nomor telepon.
* Melihat subtotal.
* Melihat ongkos kirim.
* Melihat total pembayaran.
* Membuat pesanan.

---

# 10. Order Management

## 10.1 Order Creation

Ketika Customer melakukan checkout, sistem membuat nomor order dan menyimpan:

* Customer.
* Alamat.
* Nomor HP.
* Produk.
* Jumlah.
* Harga.
* Subtotal.
* Ongkos kirim.
* Total.
* Status order.

Status awal pesanan adalah:

**Pending**

Stok produk jadi belum dikurangi pada tahap checkout. Pengurangan stok dilakukan setelah order disetujui.

## 10.2 Order Status

Status pesanan:

```text
Pending
   ↓
Approve
   ↓
Process
   ↓
Delivery
   ↓
Finish
```

Pesanan juga dapat berakhir pada:

```text
Cancel
```

Owner/Admin dapat mengubah status pesanan sesuai proses bisnis.

---

# 11. Payment Management

## 11.1 Payment Method

Metode pembayaran MVP menggunakan:

**Transfer Manual**

Sistem menampilkan informasi rekening Stalltech kepada Customer.

## 11.2 Upload Payment Proof

Customer dapat:

* Mengunggah bukti transfer.
* Memasukkan nominal pembayaran.

File bukti pembayaran harus melewati validasi tipe dan ukuran file.

## 11.3 Payment Verification

Owner/Admin dapat:

* Melihat bukti pembayaran.
* Memeriksa nominal.
* Menyetujui pembayaran.
* Menolak pembayaran.

Jika pembayaran diterima, order berubah menjadi:

**Approve**

Ketika order disetujui, sistem menjalankan proses pengurangan stok sesuai aturan inventory dan BOM.

---

# 12. Shipping Management

Owner/Admin dapat mengelola informasi pengiriman.

Data pengiriman meliputi:

* Alamat.
* Nomor HP.
* Ongkos kirim.
* Nomor resi.

Ketika pesanan dikirim, Owner/Admin memasukkan nomor resi dan mengubah status order menjadi:

**Delivery**

Customer dapat melihat nomor resi pada detail pesanan.

---

# 13. Inventory Management

## 13.1 Finished Product Inventory

Sistem menyimpan stok produk jadi.

Ketika order disetujui:

```text
Stok Produk Jadi
        ↓
   Dikurangi
```

Jumlah pengurangan mengikuti jumlah produk yang dipesan.

## 13.2 Raw Material Inventory

Owner/Admin dapat:

* Menambah stok bahan.
* Mengurangi stok bahan.
* Melihat stok bahan.
* Melihat riwayat transaksi stok.
* Menentukan minimum stock.

## 13.3 Low Stock Notification

Sistem memberikan notifikasi apabila stok bahan mencapai atau berada di bawah batas minimum.

Contoh:

```text
Stok Minimum Material = 10
Stok Saat Ini = 8

→ Sistem memberikan notifikasi kepada Owner
```

---

# 14. Bill of Materials (BOM)

## 14.1 Tujuan BOM

BOM digunakan untuk mencatat material yang dibutuhkan untuk menghasilkan atau menyediakan suatu produk.

## 14.2 BOM Detail

Setiap BOM dapat berisi:

* Product Variant.
* Material.
* Quantity.
* Unit.
* Material Cost.

## 14.3 Automatic BOM Deduction

Ketika order disetujui:

```text
Order Approved
      ↓
Baca Product Variant
      ↓
Baca BOM
      ↓
Hitung kebutuhan material
      ↓
Kurangi stok material
      ↓
Catat Stock Transaction
```

Pengurangan bahan dilakukan berdasarkan jumlah produk yang dipesan.

Contoh:

```text
BOM:
Produk A membutuhkan:
- Material X = 2 unit
- Material Y = 1 unit

Order:
Produk A = 3

Pengurangan:
Material X = 2 × 3 = 6 unit
Material Y = 1 × 3 = 3 unit
```

---

# 15. Dashboard

Dashboard Owner/Admin menampilkan informasi utama mengenai kondisi bisnis.

Informasi yang ditampilkan:

* Jumlah pesanan.
* Pendapatan.
* Produk yang diminati.
* Stok bahan.
* Stok produk jadi.
* Material yang mencapai stok minimum.

Dashboard digunakan sebagai pusat monitoring aktivitas penjualan dan inventory.

---

# 16. Reporting

Sistem menyediakan tiga kelompok laporan utama.

## 16.1 Sales Report

Berisi:

* Nomor order.
* Customer.
* Produk.
* Jumlah.
* Harga.
* Status.

## 16.2 Inventory Report

Berisi:

* Stok awal.
* Barang masuk.
* Barang keluar.
* Stok akhir.

## 16.3 Profit Report

Keuntungan dihitung menggunakan:

```text
Keuntungan = Pendapatan - Modal Material
```

Modal material dihitung berdasarkan BOM.

Ketentuan laporan tersebut mengikuti kebutuhan reporting yang ditetapkan pada SRS.

---

# 17. Export

Owner/Admin dapat mengekspor laporan ke:

* Excel
* CSV

Output digunakan untuk kebutuhan dokumentasi dan analisis data operasional.

---

# 18. Notification

Sistem memberikan notifikasi kepada pengguna berdasarkan aktivitas tertentu.

## Customer

Customer menerima notifikasi terkait:

* Status pembayaran.
* Perubahan status order.
* Informasi pengiriman.

## Owner/Admin

Owner menerima notifikasi terkait:

* Pembayaran baru yang membutuhkan verifikasi.
* Stok material minimum.

---

# 19. Main User Flow

## 19.1 Customer Purchase Flow

```text
Customer
   ↓
Registrasi / Login
   ↓
Melihat Katalog
   ↓
Memilih Jenis Motor
   ↓
Memilih Produk
   ↓
Menentukan Jumlah
   ↓
Checkout
   ↓
Mengisi Alamat & No. HP
   ↓
Sistem Menghitung Subtotal + Ongkir
   ↓
Order Pending
   ↓
Customer Transfer
   ↓
Upload Bukti Pembayaran
   ↓
Owner Verifikasi
   ↓
Pembayaran Diterima?
   ├── Tidak → Ditolak
   │
   └── Ya
        ↓
     Order Approve
        ↓
   Stok Produk Berkurang
        ↓
   Stok Material Berkurang
        ↓
     Order Process
        ↓
     Order Delivery
        ↓
     Nomor Resi
        ↓
     Order Finish
```

Alur checkout sampai selesai tersebut mengikuti skenario utama pada SRS Stalltech.

---

# 20. Business Rules

| ID     | Business Rule                                                                                      |
| ------ | -------------------------------------------------------------------------------------------------- |
| BR-001 | Owner merupakan satu-satunya pengelola perusahaan dan sekaligus Admin sistem.                      |
| BR-002 | Produk yang tersedia hanya jok motor jadi.                                                         |
| BR-003 | Customer tidak dapat melakukan custom desain, request ukuran khusus, atau memesan jasa pemasangan. |
| BR-004 | Ukuran produk ditentukan berdasarkan jenis motor: Standar atau Jumbo.                              |
| BR-005 | Stok produk jadi berkurang ketika order disetujui.                                                 |
| BR-006 | Stok bahan otomatis berkurang berdasarkan BOM ketika order disetujui.                              |
| BR-007 | Sistem tidak menjalankan proses produksi fisik.                                                    |
| BR-008 | Pembayaran menggunakan transfer manual.                                                            |
| BR-009 | Order baru berstatus Pending.                                                                      |
| BR-010 | Owner dapat mengubah status order secara manual sesuai proses bisnis.                              |
| BR-011 | Keuntungan dihitung dari pendapatan dikurangi modal material berdasarkan BOM.                      |
| BR-012 | Stok minimum menghasilkan notifikasi kepada Owner/Admin.                                           |

Business rules tersebut berasal dari aturan bisnis yang ditetapkan pada SRS.

---

# 21. Data Requirements

Data utama yang digunakan sistem:

## User

* ID
* Name
* Email
* Phone
* Address
* Password
* Role
* Timestamps

## Customer

* Data customer yang berhubungan dengan User dan Order.

## Order

* Order ID
* Customer
* Address
* Phone
* Subtotal
* Shipping Cost
* Total
* Status
* Tracking Number
* Timestamps

## Order Detail

* Order
* Product Variant
* Quantity
* Unit Price
* Subtotal

## Product

* Product ID
* Name
* Description
* Type/Size Relationship

## Product Variant

* Variant ID
* Product
* Motor Type
* Size
* Name
* Photo
* Price
* Stock

## Material

* Material ID
* Name
* Unit
* Current Stock
* Minimum Stock
* Material Cost

## BOM

* BOM ID
* Product Variant
* Material Requirements

## BOM Detail

* BOM
* Material
* Quantity
* Unit
* Material Cost

## Stock Transaction

* Material/Product
* Type In/Out
* Quantity
* Reference
* Date

## Payment

* Order ID
* Amount
* Proof
* Payment Status
* Verification Data

## Notification

* Recipient
* Type
* Message
* Read Status
* Timestamp

## Report

* Hasil agregasi laporan penjualan.
* Hasil agregasi laporan stok.
* Hasil agregasi laporan keuntungan.

Struktur data tersebut mengikuti entity overview dalam SRS.

---

# 22. Non-Functional Requirements

## Performance

Halaman utama dan dashboard harus memiliki waktu respons yang baik pada penggunaan normal.

## Availability

Sistem dapat digunakan secara online selama server tersedia.

## Security

Password harus disimpan menggunakan mekanisme hashing/encryption yang sesuai dengan Laravel.

## Authorization

Halaman dan fitur Owner/Admin hanya dapat diakses oleh Owner/Admin.

## Upload Security

File bukti pembayaran harus divalidasi berdasarkan tipe dan ukuran file.

## Data Integrity

Data Order, Payment, Inventory, dan BOM harus tetap konsisten.

## Usability

Antarmuka harus mudah digunakan oleh Owner/Admin dan Customer.

## Maintainability

Struktur kode dan modul harus terorganisasi agar sistem mudah dikembangkan.

## Compatibility

Aplikasi dapat digunakan melalui browser modern pada desktop dan perangkat yang mendukung web.

## Auditability

Perubahan stok dan status order harus dapat ditelusuri melalui riwayat data.

Ketentuan non-functional requirements tersebut mengikuti SRS Stalltech.

---

# 23. Technology Requirements

| Komponen | Teknologi          |
| -------- | ------------------ |
| Platform | Web Application    |
| Backend  | Laravel            |
| Database | MySQL              |
| Browser  | Modern Web Browser |
| Network  | Internet           |
| Export   | Excel & CSV        |

Sistem dikembangkan sebagai aplikasi web menggunakan Laravel dan MySQL.

---

# 24. MVP Priorities

## Must Have

| Feature              | Priority  |
| -------------------- | --------- |
| Authentication       | Must Have |
| Product Management   | Must Have |
| Product Variant      | Must Have |
| E-Commerce Checkout  | Must Have |
| Upload Payment Proof | Must Have |
| Order Management     | Must Have |
| Inventory Management | Must Have |
| BOM Management       | Must Have |
| Dashboard            | Must Have |
| Export Excel/CSV     | Must Have |

## Out of Scope MVP

| Feature                   | Status       |
| ------------------------- | ------------ |
| Custom Design             | Out of Scope |
| Pre-order                 | Out of Scope |
| Multi Branch              | Out of Scope |
| Multi Seller Marketplace  | Out of Scope |
| Automatic Payment Gateway | Out of Scope |
| Invoice PDF               | Out of Scope |
| Full Accounting           | Out of Scope |

Status MVP tersebut sesuai dengan lampiran scope SRS Stalltech.

---

# 25. Acceptance Criteria

## AC-001 — Product

Customer dapat melihat dan membeli produk jok motor berdasarkan jenis motor.

## AC-002 — Order

Customer dapat melakukan checkout dan mengunggah bukti pembayaran.

## AC-003 — Payment

Owner dapat memverifikasi pembayaran dan mengubah hasil verifikasi.

## AC-004 — Inventory

Owner dapat mengelola stok bahan dan produk jadi.

## AC-005 — BOM

Produk memiliki informasi kebutuhan material.

## AC-006 — Automatic Inventory

Ketika order disetujui, stok produk jadi dan material berkurang sesuai aturan BOM.

## AC-007 — Shipping

Owner dapat memasukkan ongkir dan nomor resi, sedangkan Customer dapat melihat informasi tersebut.

## AC-008 — Notification

Customer dan Owner menerima notifikasi untuk kejadian yang telah ditentukan.

## AC-009 — Dashboard

Owner dapat melihat indikator penjualan dan inventory.

## AC-010 — Report

Owner dapat melihat dan mengekspor laporan bisnis.

Acceptance criteria ini mengikuti acceptance criteria yang tercantum dalam SRS.

---

# 26. Success Criteria

Pengembangan Stalltech Management System dianggap memenuhi tujuan produk apabila:

1. Customer dapat melakukan pembelian produk jok motor melalui e-commerce.
2. Customer dapat melakukan checkout dan mengirim bukti pembayaran.
3. Owner dapat melakukan verifikasi pembayaran.
4. Owner dapat mengelola produk dan variasinya.
5. Owner dapat mengelola stok produk jadi dan bahan.
6. Sistem dapat menerapkan BOM pada produk.
7. Sistem dapat melakukan pengurangan stok berdasarkan order yang disetujui.
8. Sistem memberikan notifikasi ketika stok material mencapai batas minimum.
9. Owner dapat memantau aktivitas melalui dashboard.
10. Owner dapat menghasilkan dan mengekspor laporan penjualan, stok, dan keuntungan.

---

# 27. Traceability Product Goal

| Product Goal                  | Feature                                               |
| ----------------------------- | ----------------------------------------------------- |
| Meningkatkan penjualan online | Catalog, Motor Selection, Checkout                    |
| Mempermudah pemesanan         | Cart, Checkout, Shipping                              |
| Meningkatkan pengelolaan stok | Finished Inventory, Raw Material Inventory            |
| Menerapkan BOM                | BOM Management                                        |
| Mengotomatisasi inventory     | BOM Auto Deduction                                    |
| Monitoring bisnis             | Dashboard, Notification                               |
| Analisis bisnis               | Sales Report, Inventory Report, Profit Report, Export |

Hubungan antara tujuan produk dan kebutuhan sistem juga telah ditelusurkan dalam Traceability Matrix SRS.

---

# 28. Product Constraints

Sistem memiliki beberapa batasan:

1. Sistem hanya digunakan untuk satu perusahaan/cabang.
2. Owner merupakan satu-satunya pengelola perusahaan.
3. Owner sekaligus berperan sebagai Admin.
4. Produksi fisik tidak dijalankan oleh sistem.
5. Pembayaran menggunakan transfer manual.
6. Sistem tidak menggunakan payment gateway otomatis.
7. Produk yang dijual adalah jok motor jadi.
8. Custom desain tidak termasuk dalam sistem.
9. Pre-order tidak termasuk dalam MVP.
10. Multi-seller marketplace tidak termasuk dalam MVP.
11. Invoice PDF tidak termasuk dalam MVP.
12. Akuntansi lengkap tidak termasuk dalam MVP.

---

# 29. Future Development

Fitur berikut dapat dipertimbangkan untuk pengembangan selanjutnya:

* Payment gateway otomatis.
* Invoice PDF.
* Multi-cabang.
* Multi-seller marketplace.
* Custom desain.
* Pre-order.
* Integrasi jasa pengiriman.
* Sistem akuntansi yang lebih lengkap.
* Integrasi notifikasi eksternal.

Fitur-fitur tersebut bukan bagian dari MVP saat ini dan tidak menjadi kebutuhan utama pada versi 1.0.

---

# 30. Conclusion

Stalltech Management System merupakan sistem informasi berbasis web yang mengintegrasikan e-commerce dengan pengelolaan operasional IKM Stalltech.

Produk berfokus pada penjualan jok motor jadi melalui e-commerce serta pengelolaan produk, order, pembayaran manual, inventory produk jadi, inventory bahan, BOM, dashboard, notifikasi, dan reporting.

Customer menggunakan sistem untuk mencari dan membeli produk, melakukan checkout, mengunggah bukti pembayaran, serta memantau pesanan. Owner/Admin menggunakan sistem untuk mengelola produk, memverifikasi pembayaran, mengelola order, mengelola inventory, mengatur BOM, memantau dashboard, dan menghasilkan laporan.

Fokus otomatisasi utama berada pada hubungan antara order, inventory, dan BOM. Ketika order disetujui, sistem mengurangi stok produk jadi dan material sesuai kebutuhan BOM. Dengan rancangan tersebut, PRD menjadi dasar untuk pengembangan desain sistem, UI/UX, database, implementasi Laravel, pengujian fungsional, dan UAT.
