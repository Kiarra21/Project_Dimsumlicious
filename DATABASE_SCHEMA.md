# Database Schema - Dimsumlicious

## 📋 Overview

Dokumentasi lengkap struktur database untuk sistem pemesanan Dimsumlicious dengan fitur keranjang belanja, pembayaran QRIS, dan manajemen pesanan.

---

## 🗂️ Tabel & Relasi

### 1. **categories** (Kategori Produk)

Menyimpan kategori produk dimsum.

| Column      | Type               | Description                                       |
| ----------- | ------------------ | ------------------------------------------------- |
| id          | bigint (PK)        | ID unik kategori                                  |
| name        | varchar            | Nama kategori (contoh: Dimsum Ayam, Dimsum Udang) |
| slug        | varchar (unique)   | URL-friendly name                                 |
| description | text (nullable)    | Deskripsi kategori                                |
| image       | varchar (nullable) | Path gambar kategori                              |
| is_active   | boolean            | Status aktif/tidak (default: true)                |
| created_at  | timestamp          | Waktu dibuat                                      |
| updated_at  | timestamp          | Waktu diupdate                                    |

**Relasi:**

-   `hasMany` → `products`

---

### 2. **products** (Produk Dimsum)

Menyimpan data produk dimsum.

| Column       | Type               | Description                         |
| ------------ | ------------------ | ----------------------------------- |
| id           | bigint (PK)        | ID unik produk                      |
| category_id  | bigint (FK)        | Relasi ke categories                |
| name         | varchar            | Nama produk                         |
| slug         | varchar (unique)   | URL-friendly name                   |
| description  | text (nullable)    | Deskripsi produk                    |
| price        | decimal(10,2)      | Harga produk                        |
| stock        | integer            | Stok tersedia (default: 0)          |
| image        | varchar (nullable) | Path gambar produk                  |
| is_available | boolean            | Status ketersediaan (default: true) |
| is_featured  | boolean            | Produk unggulan (default: false)    |
| created_at   | timestamp          | Waktu dibuat                        |
| updated_at   | timestamp          | Waktu diupdate                      |

**Relasi:**

-   `belongsTo` → `categories`
-   `hasMany` → `carts`
-   `hasMany` → `order_items`

---

### 3. **carts** (Keranjang Belanja)

Menyimpan item yang ditambahkan user ke keranjang sebelum checkout.

| Column     | Type          | Description                       |
| ---------- | ------------- | --------------------------------- |
| id         | bigint (PK)   | ID unik cart item                 |
| user_id    | bigint (FK)   | Relasi ke users                   |
| product_id | bigint (FK)   | Relasi ke products                |
| quantity   | integer       | Jumlah item (default: 1)          |
| price      | decimal(10,2) | Harga saat ditambahkan (snapshot) |
| created_at | timestamp     | Waktu ditambahkan                 |
| updated_at | timestamp     | Waktu diupdate                    |

**Constraint:**

-   `UNIQUE(user_id, product_id)` - Satu user tidak bisa punya produk yang sama lebih dari sekali

**Relasi:**

-   `belongsTo` → `users`
-   `belongsTo` → `products`

**Accessor:**

-   `getSubtotalAttribute()` → `price * quantity`

---

### 4. **orders** (Pesanan)

Menyimpan pesanan yang dibuat user setelah checkout.

| Column           | Type                 | Description                            |
| ---------------- | -------------------- | -------------------------------------- |
| id               | bigint (PK)          | ID unik order                          |
| order_number     | varchar (unique)     | Nomor pesanan unik (ORD-YYYYMMDD-XXXX) |
| user_id          | bigint (FK)          | Relasi ke users (pembeli)              |
| status           | enum                 | Status pesanan (lihat detail di bawah) |
| subtotal         | decimal(12,2)        | Total harga item                       |
| tax              | decimal(10,2)        | Pajak (default: 0)                     |
| delivery_fee     | decimal(10,2)        | Ongkir (default: 0)                    |
| total            | decimal(12,2)        | Total keseluruhan                      |
| customer_notes   | text (nullable)      | Catatan dari customer                  |
| delivery_address | varchar (nullable)   | Alamat pengiriman                      |
| phone_number     | varchar              | Nomor HP untuk konfirmasi              |
| rejection_reason | text (nullable)      | Alasan jika ditolak                    |
| rejected_at      | timestamp (nullable) | Waktu ditolak                          |
| completed_at     | timestamp (nullable) | Waktu selesai                          |
| created_at       | timestamp            | Waktu dibuat                           |
| updated_at       | timestamp            | Waktu diupdate                         |

**Status Values:**

1. `pending_payment` - Menunggu pembayaran (user belum upload bukti transfer)
2. `pending_cooking` - Pembayaran terverifikasi, menunggu dimasak
3. `completed` - Pesanan selesai
4. `rejected` - Pesanan ditolak (bukti pembayaran tidak valid, dll)

**Relasi:**

-   `belongsTo` → `users`
-   `hasMany` → `order_items`
-   `hasOne` → `payments`

**Method:**

-   `generateOrderNumber()` → Generate nomor order unik

---

### 5. **order_items** (Detail Item Pesanan)

Menyimpan detail item dalam setiap pesanan (snapshot data produk).

| Column       | Type          | Description                          |
| ------------ | ------------- | ------------------------------------ |
| id           | bigint (PK)   | ID unik order item                   |
| order_id     | bigint (FK)   | Relasi ke orders                     |
| product_id   | bigint (FK)   | Relasi ke products                   |
| product_name | varchar       | Nama produk (snapshot saat order)    |
| price        | decimal(10,2) | Harga per item (snapshot saat order) |
| quantity     | integer       | Jumlah yang dipesan                  |
| subtotal     | decimal(10,2) | Total (price × quantity)             |
| created_at   | timestamp     | Waktu dibuat                         |
| updated_at   | timestamp     | Waktu diupdate                       |

**Relasi:**

-   `belongsTo` → `orders`
-   `belongsTo` → `products`

---

### 6. **payments** (Pembayaran QRIS)

Menyimpan data pembayaran dan bukti transfer.

| Column             | Type                  | Description                               |
| ------------------ | --------------------- | ----------------------------------------- |
| id                 | bigint (PK)           | ID unik payment                           |
| order_id           | bigint (FK)           | Relasi ke orders                          |
| payment_method     | varchar               | Metode pembayaran (default: 'qris')       |
| amount             | decimal(12,2)         | Jumlah yang harus dibayar                 |
| status             | enum                  | Status pembayaran (lihat detail di bawah) |
| proof_image        | varchar (nullable)    | Path gambar bukti transfer                |
| uploaded_at        | timestamp (nullable)  | Waktu upload bukti                        |
| verified_by        | bigint (FK, nullable) | Admin/Staff yang verifikasi               |
| verified_at        | timestamp (nullable)  | Waktu verifikasi                          |
| verification_notes | text (nullable)       | Catatan verifikasi/penolakan              |
| qris_image         | varchar (nullable)    | Path gambar QR code QRIS                  |
| created_at         | timestamp             | Waktu dibuat                              |
| updated_at         | timestamp             | Waktu diupdate                            |

**Status Values:**

1. `pending` - Menunggu upload bukti transfer
2. `verified` - Bukti transfer terverifikasi
3. `rejected` - Bukti transfer ditolak (bisa upload ulang)

**Relasi:**

-   `belongsTo` → `orders`
-   `belongsTo` → `users` (as verified_by)

---

## 🔄 Flow Pemesanan

### 1. **Browse & Add to Cart**

```
User login → Browse products → Add to cart (carts table)
- Jika produk sudah ada di cart, update quantity
- Jika produk baru, insert new cart item
```

### 2. **Checkout**

```
User → View cart → Checkout
- Create order (orders table) dengan status: pending_payment
- Copy cart items ke order_items table (snapshot data)
- Create payment record (payments table) dengan status: pending
- Clear user's cart
- Generate QRIS QR code
```

### 3. **Upload Bukti Transfer**

```
User → View order → Upload proof image
- Update payments.proof_image
- Update payments.uploaded_at
- Notifikasi ke admin/staff
```

### 4. **Verifikasi Admin/Staff**

```
Admin/Staff → View pending payments → Verify/Reject

JIKA VERIFIED:
- Update payments.status = 'verified'
- Update payments.verified_by = admin_id
- Update payments.verified_at = now()
- Update orders.status = 'pending_cooking'

JIKA REJECTED:
- Update payments.status = 'rejected'
- Update payments.verification_notes = reason
- User bisa upload ulang bukti transfer
```

### 5. **Update Status Pesanan**

```
Admin/Staff → Update order status

pending_cooking → completed:
- Update orders.status = 'completed'
- Update orders.completed_at = now()
```

---

## 📊 Relasi Database (ERD)

```
users (1) ─────→ (n) carts
users (1) ─────→ (n) orders
users (1) ─────→ (n) payments (as verified_by)

categories (1) ─→ (n) products

products (1) ───→ (n) carts
products (1) ───→ (n) order_items

orders (1) ─────→ (n) order_items
orders (1) ─────→ (1) payments
```

---

## 🎯 Use Cases

### User

1. ✅ Browse produk dimsum
2. ✅ Add produk ke keranjang
3. ✅ Update quantity di keranjang
4. ✅ Remove item dari keranjang
5. ✅ Checkout (buat pesanan)
6. ✅ Upload bukti transfer QRIS
7. ✅ Re-upload jika ditolak
8. ✅ View history pesanan

### Admin/Staff

1. ✅ View semua ajuan pesanan
2. ✅ Verifikasi/Reject bukti pembayaran
3. ✅ Update status pesanan
4. ✅ View detail pesanan
5. ✅ Manage produk & kategori
6. ✅ View laporan penjualan

---

## 🚀 Cara Menjalankan Migration

```bash
# Jalankan semua migration
php artisan migrate

# Atau migrate fresh (reset database)
php artisan migrate:fresh

# Dengan seeder
php artisan migrate:fresh --seed
```

---

## 📝 Catatan Penting

1. **Order Number Format:** `ORD-YYYYMMDD-XXXX`

    - Contoh: `ORD-20250112-0001`

2. **Status Flow:**

    ```
    Orders: pending_payment → pending_cooking → completed
                           ↓
                       rejected (bisa upload ulang)

    Payments: pending → verified → (order status: pending_cooking)
                     ↓
                 rejected → (user upload ulang)
    ```

3. **Snapshot Data:**

    - `order_items` menyimpan snapshot `product_name` dan `price` saat order dibuat
    - Jika harga produk berubah di masa depan, tidak mempengaruhi order lama

4. **QRIS Integration:**

    - Generate QR code saat order dibuat
    - Simpan di `payments.qris_image`
    - User scan → transfer → upload bukti

5. **Security:**
    - Upload bukti transfer: validate image (jpg, png, max 2MB)
    - Only authenticated users bisa order
    - Only admin/staff bisa verifikasi pembayaran

---

**Generated on:** 2025-11-12
**Laravel Version:** 11.x
**Database:** MySQL
