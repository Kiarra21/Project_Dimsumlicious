# DOKUMENTASI ENTITAS DATABASE

## Project Dimsumlicious - Sistem Informasi Manajemen Dimsum

---

## 1. ENTITAS: users

| **Nama Entity**             | users                                                                                                                           |
| --------------------------- | ------------------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Master                                                                                                                     |
| **Deskripsi**               | Menyimpan data pengguna sistem (admin, staff, dan customer) dengan informasi akun dan otentikasi                                |
| **Alasan dijadikan entity** | Untuk mengelola pengguna yang dapat mengakses sistem dengan role berbeda-beda, serta menangani authentication dan authorization |

### Atribut:

-   **id**: ID unik pengguna (integer, pk)
-   **name**: Nama lengkap pengguna (string, max 255)
-   **email**: Email pengguna untuk login (string, unique)
-   **email_verified_at**: Waktu verifikasi email (timestamp, nullable)
-   **password**: Password terenkripsi (string)
-   **role_id**: ID role pengguna (integer, fk → roles)
-   **remember_token**: Token untuk fitur "Remember Me" (string, nullable)
-   **created_at**: Waktu pembuatan akun (timestamp)
-   **updated_at**: Waktu terakhir diupdate (timestamp)

### Keterangan:

Menjadi pusat dari sistem otentikasi dan otorisasi. Setiap pengguna harus login untuk mengakses fitur-fitur sistem. Role menentukan hak akses: admin dapat mengelola semua data, staff dapat mengelola produk dan verifikasi pembayaran, sedangkan customer dapat berbelanja dan membuat pesanan.

---

## 2. ENTITAS: roles

| **Nama Entity**             | roles                                                                                                                 |
| --------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Master                                                                                                           |
| **Deskripsi**               | Menyimpan data role/peran pengguna dalam sistem untuk keperluan authorization                                         |
| **Alasan dijadikan entity** | Untuk memisahkan hak akses berdasarkan role sehingga setiap pengguna hanya dapat mengakses fitur sesuai kewenangannya |

### Atribut:

-   **id**: ID unik role (integer, pk)
-   **name**: Nama role (string, unique) - nilai: admin, staff, user
-   **display_name**: Nama tampilan role (string) - nilai: Admin, Staff, User
-   **description**: Deskripsi role (text, nullable)
-   **permissions**: Array permissions dalam format JSON (json, nullable)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Mendukung sistem role-based access control (RBAC) dengan 3 role utama: Admin (akses penuh ke semua fitur), Staff (dapat mengelola produk, verifikasi pembayaran, kelola pesanan), dan User (dapat berbelanja, buat pesanan, upload bukti pembayaran).

---

## 3. ENTITAS: categories

| **Nama Entity**             | categories                                                                                              |
| --------------------------- | ------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Master                                                                                             |
| **Deskripsi**               | Menyimpan data kategori produk dimsum untuk pengelompokan produk                                        |
| **Alasan dijadikan entity** | Untuk mengorganisir produk berdasarkan jenis/kategori sehingga memudahkan navigasi dan pencarian produk |

### Atribut:

-   **id**: ID unik kategori (integer, pk)
-   **name**: Nama kategori (string) - contoh: Dimsum Ayam, Dimsum Udang, Dimsum Sayuran
-   **slug**: URL-friendly name (string, unique)
-   **description**: Deskripsi kategori (text, nullable)
-   **image**: Path gambar kategori (string, nullable)
-   **is_active**: Status aktif/nonaktif (boolean, default: true)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Memudahkan customer mencari produk berdasarkan jenis dimsum yang diinginkan. Admin dapat mengelola kategori dan mengaktifkan/menonaktifkan kategori tertentu tanpa menghapus data.

---

## 4. ENTITAS: products

| **Nama Entity**             | products                                                                                                                         |
| --------------------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Transaksi                                                                                                                   |
| **Deskripsi**               | Menyimpan data produk dimsum yang dijual, termasuk informasi harga, stok, dan diskon                                             |
| **Alasan dijadikan entity** | Untuk mengelola katalog produk dimsum yang dijual, menampilkan informasi ke customer, dan menghitung harga dengan diskon promosi |

### Atribut:

-   **id**: ID unik produk (integer, pk)
-   **category_id**: ID kategori produk (integer, fk → categories)
-   **name**: Nama produk (string) - contoh: Dimsum Ayam Original
-   **slug**: URL-friendly name (string, unique)
-   **description**: Deskripsi produk (text, nullable)
-   **price**: Harga normal produk (decimal 10,2) - contoh: 25000.00
-   **promo_id**: ID promosi yang diterapkan (integer, nullable)
-   **has_discount**: Status ada diskon atau tidak (boolean, default: false)
-   **discount_price**: Harga setelah diskon (decimal 10,2, nullable)
-   **stock**: Jumlah stok produk (integer, default: 0)
-   **image**: Path gambar produk (string, nullable)
-   **is_available**: Status ketersediaan (boolean, default: true)
-   **is_featured**: Status produk unggulan (boolean, default: false)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Jantung dari sistem e-commerce. Menyimpan semua informasi produk termasuk harga normal dan harga diskon. Sistem otomatis menghitung discount_price berdasarkan persentase diskon dari promo yang diterapkan. Produk yang stoknya habis atau tidak tersedia dapat dinonaktifkan tanpa menghapus data historis.

---

## 5. ENTITAS: promos

| **Nama Entity**             | promos                                                                                                                                     |
| --------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| **Kategori**                | Data Transaksi                                                                                                                             |
| **Deskripsi**               | Menyimpan data promosi/diskon dengan periode waktu tertentu untuk diterapkan pada produk                                                   |
| **Alasan dijadikan entity** | Untuk mengelola kampanye promosi dengan sistem diskon persentase yang dapat diterapkan ke beberapa produk sekaligus dalam periode tertentu |

### Atribut:

-   **id**: ID unik promo (integer, pk)
-   **title**: Judul promosi (string) - contoh: "Diskon 20% Akhir Pekan"
-   **description**: Deskripsi detail promosi (text)
-   **discount**: Persentase diskon (integer, 0-100, default: 0)
-   **banner_image**: Path gambar banner promosi (string, nullable)
-   **start_date**: Tanggal mulai promo (date)
-   **end_date**: Tanggal akhir promo (date)
-   **is_active**: Status aktif/nonaktif (boolean, default: true)
-   **created_by**: ID admin/staff yang membuat (integer, fk → users)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Mendukung strategi marketing dengan sistem promosi berbasis waktu. Admin dapat membuat promosi dengan periode tertentu, dan sistem akan otomatis menghitung harga diskon produk yang menggunakan promo tersebut. Promo dapat diaktifkan/dinonaktifkan untuk mengontrol ketersediaan diskon.

---

## 6. ENTITAS: carts

| **Nama Entity**             | carts                                                                                                                  |
| --------------------------- | ---------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Transaksi                                                                                                         |
| **Deskripsi**               | Menyimpan data keranjang belanja customer sebelum checkout menjadi order                                               |
| **Alasan dijadikan entity** | Untuk menyimpan sementara produk yang dipilih customer sebelum melakukan pemesanan, memudahkan proses belanja bertahap |

### Atribut:

-   **id**: ID unik cart item (integer, pk)
-   **user_id**: ID customer pemilik keranjang (integer, fk → users)
-   **product_id**: ID produk yang ditambahkan (integer, fk → products)
-   **quantity**: Jumlah item (integer, default: 1)
-   **price**: Harga saat item ditambahkan (decimal 10,2)
-   **created_at**: Waktu ditambahkan ke keranjang (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)
-   **UNIQUE**: Kombinasi user_id + product_id harus unik

### Keterangan:

Memfasilitasi pengalaman belanja yang nyaman dengan menyimpan produk pilihan sebelum checkout. Setiap user hanya bisa memiliki satu entry per produk di keranjang (quantity dapat diupdate). Harga di-snapshot saat item ditambahkan untuk menghindari perubahan harga yang tidak terduga saat checkout.

---

## 7. ENTITAS: orders

| **Nama Entity**             | orders                                                                                                                     |
| --------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Transaksi                                                                                                             |
| **Deskripsi**               | Menyimpan data pesanan customer beserta status, total pembayaran, dan informasi pengiriman                                 |
| **Alasan dijadikan entity** | Untuk mencatat transaksi penjualan dimsum, tracking status pesanan dari pending hingga selesai, dan menghitung total biaya |

### Atribut:

-   **id**: ID unik order (integer, pk)
-   **order_number**: Nomor pesanan unik (string, unique) - format: ORD-20250112-0001
-   **user_id**: ID customer pemesan (integer, fk → users)
-   **status**: Status pesanan (enum: pending_payment, pending_cooking, completed, rejected)
-   **subtotal**: Total harga item (decimal 12,2)
-   **tax**: Pajak jika ada (decimal 10,2, default: 0)
-   **delivery_fee**: Ongkir jika ada (decimal 10,2, default: 0)
-   **total**: Total keseluruhan (decimal 12,2)
-   **customer_notes**: Catatan dari customer (text, nullable)
-   **delivery_address**: Alamat pengiriman (string, nullable)
-   **phone_number**: Nomor HP untuk konfirmasi (string)
-   **rejection_reason**: Alasan penolakan jika ditolak (text, nullable)
-   **rejected_at**: Waktu ditolak (timestamp, nullable)
-   **completed_at**: Waktu selesai (timestamp, nullable)
-   **created_at**: Waktu order dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Pusat dari proses transaksi penjualan. Order memiliki lifecycle: pending_payment (menunggu upload bukti bayar) → pending_cooking (pembayaran verified, pesanan diproses) → completed (pesanan selesai) atau rejected (pembayaran ditolak/pesanan dibatalkan). Sistem tracking memungkinkan customer dan staff memonitor status pesanan secara real-time.

---

## 8. ENTITAS: order_items

| **Nama Entity**             | order_items                                                                                                                    |
| --------------------------- | ------------------------------------------------------------------------------------------------------------------------------ |
| **Kategori**                | Data Transaksi                                                                                                                 |
| **Deskripsi**               | Menyimpan detail item/produk dalam setiap pesanan untuk breakdown transaksi                                                    |
| **Alasan dijadikan entity** | Untuk mencatat detail produk yang dipesan dalam satu order, karena satu order dapat berisi banyak produk dengan jumlah berbeda |

### Atribut:

-   **id**: ID unik order item (integer, pk)
-   **order_id**: ID order induk (integer, fk → orders)
-   **product_id**: ID produk yang dipesan (integer, fk → products)
-   **product_name**: Snapshot nama produk (string)
-   **price**: Snapshot harga per item (decimal 10,2)
-   **quantity**: Jumlah item yang dipesan (integer)
-   **subtotal**: Total untuk item ini (decimal 10,2) - price × quantity
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Menyimpan snapshot data produk (nama dan harga) saat order dibuat untuk histori yang akurat, meskipun produk diupdate atau dihapus kemudian. Relasi one-to-many dengan orders memungkinkan satu order memiliki banyak item. Subtotal dihitung otomatis untuk memudahkan kalkulasi total order.

---

## 9. ENTITAS: payments

| **Nama Entity**             | payments                                                                                                      |
| --------------------------- | ------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Transaksi                                                                                                |
| **Deskripsi**               | Menyimpan data pembayaran order termasuk bukti transfer, status verifikasi, dan metode pembayaran             |
| **Alasan dijadikan entity** | Untuk mengelola proses pembayaran, upload bukti transfer customer, dan verifikasi pembayaran oleh admin/staff |

### Atribut:

-   **id**: ID unik payment (integer, pk)
-   **order_id**: ID order yang dibayar (integer, fk → orders)
-   **payment_method**: Metode pembayaran (string, default: 'qris')
-   **amount**: Jumlah yang harus dibayar (decimal 12,2)
-   **status**: Status pembayaran (enum: pending, verified, rejected, default: pending)
-   **proof_image**: Path gambar bukti transfer (string, nullable)
-   **uploaded_at**: Waktu upload bukti (timestamp, nullable)
-   **verified_by**: ID admin/staff yang verifikasi (integer, fk → users, nullable)
-   **verified_at**: Waktu verifikasi (timestamp, nullable)
-   **verification_notes**: Catatan verifikasi/penolakan (text, nullable)
-   **qris_image**: Path gambar QR code QRIS (string, nullable)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu diupdate (timestamp)

### Keterangan:

Mengatur workflow pembayaran: customer upload bukti transfer → admin/staff verifikasi → status order berubah. Saat ini support metode QRIS dengan QR code yang ditampilkan ke customer. Verifikasi manual oleh staff memastikan pembayaran valid sebelum order diproses. Rejection dapat dilakukan dengan catatan alasan untuk transparansi.

---

## 10. ENTITAS: company_profile

| **Nama Entity**             | company_profile                                                                                                                    |
| --------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| **Kategori**                | Data Master                                                                                                                        |
| **Deskripsi**               | Menyimpan informasi profil perusahaan Dimsumlicious (singleton record) untuk ditampilkan di website                                |
| **Alasan dijadikan entity** | Untuk mengelola informasi perusahaan secara terpusat yang dapat diupdate tanpa mengubah kode, mendukung branding dan kontak bisnis |

### Atribut:

-   **id**: ID unik (integer, pk) - selalu 1
-   **company_name**: Nama perusahaan (string, default: 'Dimsumlicious')
-   **tagline**: Tagline perusahaan (string, nullable)
-   **about_us**: Deskripsi tentang perusahaan (text, nullable)
-   **address**: Alamat toko/lokasi (text)
-   **phone**: Nomor telepon (string)
-   **whatsapp**: Nomor WhatsApp (string, nullable)
-   **email**: Email perusahaan (string, nullable)
-   **logo**: Path logo perusahaan (string, nullable)
-   **hero_image**: Path gambar hero homepage (string, nullable)
-   **operating_hours_weekdays**: Jam operasional hari kerja (string, nullable)
-   **operating_hours_weekend**: Jam operasional akhir pekan (string, nullable)
-   **instagram**: Handle Instagram (string, nullable)
-   **facebook**: Halaman Facebook (string, nullable)
-   **tiktok**: Handle TikTok (string, nullable)
-   **founded_year**: Tahun berdiri (integer, nullable)
-   **updated_by**: ID admin yang terakhir edit (integer, fk → users, nullable)
-   **created_at**: Waktu dibuat (timestamp)
-   **updated_at**: Waktu terakhir diupdate (timestamp)

### Keterangan:

Singleton pattern - hanya ada 1 record untuk menyimpan informasi perusahaan. Admin dapat mengedit informasi ini yang akan langsung ter-update di seluruh website. Tracking updated_by memberikan audit trail siapa yang terakhir mengubah profil perusahaan. Mendukung integrasi social media dan informasi kontak untuk komunikasi dengan customer.

---

## DIAGRAM RELASI ANTAR ENTITAS

### Relasi One-to-Many:

1. **users → roles**: Satu role dapat dimiliki banyak user
2. **categories → products**: Satu kategori memiliki banyak produk
3. **promos → products**: Satu promo dapat diterapkan ke banyak produk
4. **users → orders**: Satu user dapat membuat banyak order
5. **orders → order_items**: Satu order berisi banyak item produk
6. **users → carts**: Satu user memiliki banyak item di keranjang
7. **products → carts**: Satu produk dapat ada di banyak keranjang
8. **products → order_items**: Satu produk dapat dipesan di banyak order
9. **users → promos** (created_by): Satu user dapat membuat banyak promo
10. **users → company_profile** (updated_by): Tracking user yang update profil

### Relasi One-to-One:

1. **orders → payments**: Setiap order memiliki satu record pembayaran
2. **company_profile**: Singleton (hanya 1 record)

### Foreign Key Constraints:

-   **CASCADE**: Jika parent dihapus, child ikut terhapus (users→orders, orders→order_items, dll)
-   **SET NULL**: Jika parent dihapus, foreign key di-set NULL (verified_by, updated_by)
-   **NO CONSTRAINT**: products.promo_id tidak ada constraint karena migration order (promo dibuat setelah product)

---

## KESIMPULAN

Database Dimsumlicious dirancang dengan 10 entitas utama yang saling berelasi untuk mendukung sistem e-commerce penjualan dimsum:

**Data Master** (4 entitas):

-   users, roles, categories, company_profile

**Data Transaksi** (6 entitas):

-   products, promos, carts, orders, order_items, payments

Setiap entitas memiliki atribut yang lengkap dan relasi yang jelas untuk menjaga integritas data. Sistem mendukung workflow lengkap dari browsing produk → add to cart → checkout → payment verification → order completion dengan tracking status yang transparan untuk semua pihak.
