# 🎉 Migration & Database Setup - COMPLETED!

## ✅ Status: Berhasil Dibuat

Semua migration dan seeder telah berhasil dibuat dan dijalankan!

---

## 📊 Tabel yang Dibuat

### 1. **categories** ✅

-   ✅ Migration: `2025_11_11_212610_create_categories_table.php`
-   ✅ Model: `app/Models/Category.php`
-   ✅ Seeder: `CategorySeeder.php` (5 kategori)

**Struktur:**

-   Menyimpan kategori produk dimsum
-   Relasi: `hasMany` → products

### 2. **products** ✅

-   ✅ Migration: `2025_11_11_212615_create_products_table.php`
-   ✅ Model: `app/Models/Product.php`
-   ✅ Seeder: `ProductSeeder.php` (11 produk)

**Struktur:**

-   Menyimpan produk dimsum dengan harga dan stok
-   Relasi: `belongsTo` → categories, `hasMany` → carts, order_items

### 3. **carts** ✅

-   ✅ Migration: `2025_11_11_212620_create_carts_table.php`
-   ✅ Model: `app/Models/Cart.php`

**Struktur:**

-   Keranjang belanja user sebelum checkout
-   Constraint: `UNIQUE(user_id, product_id)`
-   Relasi: `belongsTo` → users, products

### 4. **orders** ✅

-   ✅ Migration: `2025_11_11_212625_create_orders_table.php`
-   ✅ Model: `app/Models/Order.php`

**Struktur:**

-   Pesanan user setelah checkout
-   Status: `pending_payment`, `pending_cooking`, `completed`, `rejected`
-   Nomor order otomatis: `ORD-YYYYMMDD-XXXX`
-   Relasi: `belongsTo` → users, `hasMany` → order_items, `hasOne` → payments

### 5. **order_items** ✅

-   ✅ Migration: `2025_11_11_212630_create_order_items_table.php`
-   ✅ Model: `app/Models/OrderItem.php`

**Struktur:**

-   Detail item dalam pesanan (snapshot produk)
-   Menyimpan nama produk dan harga saat order dibuat
-   Relasi: `belongsTo` → orders, products

### 6. **payments** ✅

-   ✅ Migration: `2025_11_11_212635_create_payments_table.php`
-   ✅ Model: `app/Models/Payment.php`

**Struktur:**

-   Pembayaran dengan QRIS
-   Status: `pending`, `verified`, `rejected`
-   Upload bukti transfer (bisa re-upload jika ditolak)
-   Relasi: `belongsTo` → orders, users (as verified_by)

---

## 🎯 Flow Sistem Pemesanan

### 1. User Browse Produk

```
Homepage → Lihat produk → Klik "Add to Cart"
```

### 2. Keranjang Belanja

```
User login → Add produk ke cart → Update quantity → Checkout
```

### 3. Checkout (Buat Pesanan)

```
Cart → Checkout
├── Create Order (status: pending_payment)
├── Create Order Items (snapshot dari cart)
├── Create Payment (status: pending, generate QRIS)
└── Clear Cart
```

### 4. Upload Bukti Transfer

```
User → View Order → Scan QRIS → Transfer → Upload Bukti
├── Update payments.proof_image
├── Update payments.uploaded_at
└── Notifikasi ke Admin/Staff
```

### 5. Verifikasi Admin/Staff

```
Admin/Staff → View Pending Payments

JIKA VERIFIED:
├── payments.status = 'verified'
├── orders.status = 'pending_cooking'
└── Notifikasi ke User

JIKA REJECTED:
├── payments.status = 'rejected'
├── payments.verification_notes = "Alasan penolakan"
└── User bisa upload ulang bukti
```

### 6. Update Status Pesanan

```
Admin/Staff → Update Order
├── pending_cooking → completed
└── orders.completed_at = now()
```

---

## 📦 Data Seed (Sample Data)

### Kategori (5 items)

1. **Dimsum Ayam** - Dimsum dengan isian ayam pilihan
2. **Dimsum Udang** - Dimsum dengan udang segar
3. **Dimsum Campur** - Kombinasi ayam dan udang
4. **Dimsum Sayuran** - Vegetarian
5. **Paket Hemat** - Paket dengan harga spesial

### Produk (11 items)

| Produk                | Kategori | Harga      | Stock |
| --------------------- | -------- | ---------- | ----- |
| Dimsum Ayam Original  | Ayam     | Rp 25.000  | 100   |
| Dimsum Ayam Keju      | Ayam     | Rp 28.000  | 80    |
| Dimsum Ayam Pedas     | Ayam     | Rp 27.000  | 75    |
| Dimsum Udang Original | Udang    | Rp 30.000  | 90    |
| Dimsum Udang Keju     | Udang    | Rp 33.000  | 70    |
| Dimsum Campur Spesial | Campur   | Rp 32.000  | 85    |
| Dimsum Sayur Original | Sayuran  | Rp 22.000  | 60    |
| Dimsum Sayur Jamur    | Sayuran  | Rp 24.000  | 55    |
| Paket Hemat 10 Pcs    | Paket    | Rp 45.000  | 50    |
| Paket Hemat 20 Pcs    | Paket    | Rp 85.000  | 40    |
| Paket Keluarga 50 Pcs | Paket    | Rp 200.000 | 20    |

### Users (3 accounts)

1. **Admin** - admin@dimsumlicious.com (password: 12345678)
2. **Staff** - staff@dimsumlicious.com (password: 12345678)
3. **User** - user@dimsumlicious.com (password: 12345678)

---

## 🔗 Relasi Database (ERD)

```
┌─────────────┐
│   users     │
└─────────────┘
      │ 1
      ├──────────→ n ┌─────────────┐
      │              │    carts    │
      │              └─────────────┘
      │                     │ n
      │                     ↓ 1
      │              ┌─────────────┐
      ├──────────→ n │   orders    │
      │              └─────────────┘
      │                     │ 1
      │                     ├──────→ n ┌──────────────┐
      │                     │          │ order_items  │
      │                     │          └──────────────┘
      │                     │                 │ n
      │                     │                 ↓ 1
      │                     ↓ 1        ┌─────────────┐
      │              ┌─────────────┐   │  products   │
      └─────────→ n  │  payments   │   └─────────────┘
       (verified_by) └─────────────┘          │ n
                                               ↓ 1
                                        ┌─────────────┐
                                        │ categories  │
                                        └─────────────┘
```

---

## 🚀 Cara Penggunaan

### Reset Database & Seed Ulang

```bash
php artisan migrate:fresh --seed
```

### Hanya Jalankan Seeder

```bash
php artisan db:seed
```

### Jalankan Seeder Spesifik

```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

---

## 📝 Catatan Penting

### 1. Order Number Format

-   Format: `ORD-YYYYMMDD-XXXX`
-   Contoh: `ORD-20250112-0001`
-   Auto-increment per hari

### 2. Status Flow

**Orders:**

```
pending_payment → pending_cooking → completed
                ↓
              rejected (bisa re-order)
```

**Payments:**

```
pending → verified → (order: pending_cooking)
        ↓
      rejected → (user upload ulang)
```

### 3. Snapshot Data

-   `order_items.product_name` dan `order_items.price` adalah snapshot saat order dibuat
-   Jika harga produk berubah, tidak mempengaruhi order lama

### 4. QRIS Integration

-   Generate QR code saat order dibuat
-   Simpan di `payments.qris_image`
-   User scan → transfer → upload bukti

### 5. Upload Bukti Transfer

-   Format: JPG, PNG, JPEG
-   Max size: 2MB
-   Path: `storage/app/public/payment_proofs/`
-   Bisa re-upload jika ditolak

### 6. Permissions

-   **User**: Browse, cart, checkout, upload bukti
-   **Staff**: Verifikasi pembayaran, update status order
-   **Admin**: Full access (manage produk, verifikasi, laporan)

---

## 📁 File Locations

### Migrations

```
database/migrations/
├── 2025_11_11_212610_create_categories_table.php
├── 2025_11_11_212615_create_products_table.php
├── 2025_11_11_212620_create_carts_table.php
├── 2025_11_11_212625_create_orders_table.php
├── 2025_11_11_212630_create_order_items_table.php
└── 2025_11_11_212635_create_payments_table.php
```

### Models

```
app/Models/
├── Category.php
├── Product.php
├── Cart.php
├── Order.php
├── OrderItem.php
└── Payment.php
```

### Seeders

```
database/seeders/
├── CategorySeeder.php
├── ProductSeeder.php
└── DatabaseSeeder.php (updated)
```

---

## ✅ Checklist

-   [x] Migration categories dibuat
-   [x] Migration products dibuat
-   [x] Migration carts dibuat
-   [x] Migration orders dibuat
-   [x] Migration order_items dibuat
-   [x] Migration payments dibuat
-   [x] Model Category dengan relasi
-   [x] Model Product dengan relasi
-   [x] Model Cart dengan relasi
-   [x] Model Order dengan relasi & method
-   [x] Model OrderItem dengan relasi
-   [x] Model Payment dengan relasi
-   [x] Update User model dengan relasi
-   [x] CategorySeeder dengan 5 data
-   [x] ProductSeeder dengan 11 data
-   [x] Update DatabaseSeeder
-   [x] Migrate fresh berhasil
-   [x] Seed berhasil dijalankan
-   [x] Dokumentasi lengkap (DATABASE_SCHEMA.md)

---

## 🎯 Next Steps

1. **Create Controllers**
    - CartController (add, update, remove, view)
    - OrderController (checkout, view, upload proof)
    - PaymentController (verify, reject)
2. **Create Views**
    - Product listing page
    - Cart page
    - Checkout page
    - Order detail page (with QRIS & upload)
    - Admin order management page
3. **Create Routes**
    - User routes (cart, checkout, orders)
    - Admin routes (verify payments, manage orders)
4. **Storage Setup**
    - Create storage link: `php artisan storage:link`
    - Setup directories untuk product images & payment proofs
5. **QRIS Integration**
    - Generate QR code library
    - Payment gateway (optional)

---

**Generated:** 2025-11-12  
**Status:** ✅ COMPLETED  
**Laravel Version:** 11.x  
**Database:** MySQL

🎉 **Selamat! Database schema untuk sistem pemesanan Dimsumlicious sudah siap digunakan!**
