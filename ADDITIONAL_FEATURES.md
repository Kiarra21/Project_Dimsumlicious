# 🎉 Additional Features - Migration & Model Documentation

## ✅ New Tables Created

### 1. **promos** (Manajemen Promosi)

Tabel untuk mengelola promosi/promo yang ditampilkan di homepage.

#### Struktur Tabel:

| Column       | Type               | Description                                  |
| ------------ | ------------------ | -------------------------------------------- |
| id           | bigint (PK)        | ID unik promo                                |
| title        | varchar            | Judul promosi (contoh: "Diskon 20% Weekend") |
| description  | text               | Deskripsi detail promosi                     |
| banner_image | varchar (nullable) | Path gambar banner promosi                   |
| start_date   | date               | Tanggal mulai promo                          |
| end_date     | date               | Tanggal akhir promo                          |
| is_active    | boolean            | Status aktif/tidak aktif (default: true)     |
| created_by   | bigint (FK)        | Admin/Staff yang membuat promo               |
| created_at   | timestamp          | Waktu dibuat                                 |
| updated_at   | timestamp          | Waktu diupdate                               |

#### Relasi:

-   `belongsTo` → `users` (as created_by)

#### Methods:

-   `isValid()` - Check apakah promo masih berlaku
-   `scopeActive()` - Hanya promo yang aktif
-   `scopeOngoing()` - Promo yang sedang berjalan

---

### 2. **company_profile** (Landing Page Settings)

Tabel untuk mengelola informasi company profile yang ditampilkan di homepage.

**Note:** Hanya ada **1 record** (singleton pattern)

#### Struktur Tabel:

| Column       | Type               | Description                                |
| ------------ | ------------------ | ------------------------------------------ |
| id           | bigint (PK)        | ID (selalu 1)                              |
| company_name | varchar            | Nama perusahaan (default: "Dimsumlicious") |
| about_us     | text               | Deskripsi singkat tentang Dimsumlicious    |
| address      | text               | Alamat lengkap toko/lokasi                 |
| phone        | varchar            | Nomor telepon                              |
| whatsapp     | varchar            | Nomor WhatsApp                             |
| email        | varchar (nullable) | Email perusahaan                           |
| logo         | varchar (nullable) | Path logo perusahaan                       |
| hero_image   | varchar (nullable) | Path gambar hero di homepage               |
| social_media | text (nullable)    | JSON untuk social media links              |
| created_at   | timestamp          | Waktu dibuat                               |
| updated_at   | timestamp          | Waktu diupdate                             |

#### Methods:

-   `getProfile()` - Mendapatkan/create company profile (singleton)

#### Social Media JSON Format:

```json
{
    "instagram": "https://instagram.com/dimsumlicious",
    "facebook": "https://facebook.com/dimsumlicious",
    "tiktok": "https://tiktok.com/@dimsumlicious"
}
```

---

## 📋 Feature Mapping

### **ADMIN Features:**

#### 1. Manajemen Produk ✅

-   **Tabel**: `products`
-   **Actions**: Tambah, Edit, Hapus, Atur status ketersediaan
-   **Columns**: name, description, price, stock, image, is_available

#### 2. Manajemen Kategori ✅

-   **Tabel**: `categories`
-   **Actions**: Tambah, Edit kategori
-   **Columns**: name, description, image, is_active

#### 3. Manajemen Staff ✅

-   **Tabel**: `users` + `roles`
-   **Actions**: Tambah akun staff, atur username/password
-   **Columns**: name, email, password, role_id

#### 4. Laporan Penjualan & Keuangan ✅

-   **Tabel**: `orders`, `order_items`, `payments`
-   **Data**: Transaksi, keuntungan, grafik penjualan
-   **Reports**: Harian, mingguan, bulanan

#### 5. Manajemen Promosi ✅ **NEW!**

-   **Tabel**: `promos`
-   **Actions**: Tambah, Edit, Hapus promosi
-   **Columns**: title, description, banner_image, start_date, end_date, is_active

#### 6. Manajemen Company Profile ✅ **NEW!**

-   **Tabel**: `company_profile`
-   **Actions**: Edit informasi perusahaan
-   **Columns**: about_us, address, phone, whatsapp, logo, hero_image, social_media

---

### **STAFF Features:**

#### 1. Manajemen Produk (Terbatas) ✅

-   **Tabel**: `products`
-   **Actions**: Tambah, Edit (dalam batas izin admin), Update stok
-   **Permissions**: Terbatas sesuai role

#### 2. Manajemen Promosi ✅ **NEW!**

-   **Tabel**: `promos`
-   **Actions**: Tambah, Edit promosi, Upload banner
-   **Columns**: Same as admin

#### 3. Monitoring Penjualan ✅

-   **Tabel**: `orders`, `order_items`
-   **Actions**: View transaksi (read-only, tanpa download laporan)
-   **Restrictions**: Tidak bisa akses laporan keuangan

---

## 🎨 Homepage Integration

### Promo Section (Home.blade.php)

```php
@php
    $promos = \App\Models\Promo::ongoing()->take(2)->get();
@endphp

@foreach($promos as $promo)
    <div class="promo-card">
        <img src="{{ asset('storage/' . $promo->banner_image) }}">
        <h3>{{ $promo->title }}</h3>
        <p>{{ $promo->description }}</p>
        <span>Berlaku sampai {{ $promo->end_date->format('d M Y') }}</span>
    </div>
@endforeach
```

### Company Profile Section

```php
@php
    $company = \App\Models\CompanyProfile::getProfile();
@endphp

<!-- About Section -->
<section id="tentang">
    <h2>Tentang {{ $company->company_name }}</h2>
    <p>{{ $company->about_us }}</p>
</section>

<!-- Contact Section -->
<section id="kontak">
    <div>📍 {{ $company->address }}</div>
    <div>📞 {{ $company->phone }}</div>
    <div>📱 {{ $company->whatsapp }}</div>
    <div>📧 {{ $company->email }}</div>
</section>

<!-- Social Media -->
@foreach($company->social_media as $platform => $url)
    <a href="{{ $url }}">{{ ucfirst($platform) }}</a>
@endforeach
```

---

## 📊 Database Relationships

```
users (1) ────→ (n) promos (created_by)

company_profile (singleton - always 1 record)
```

---

## 🚀 Usage Examples

### Create Promo

```php
Promo::create([
    'title' => 'Diskon 50% Lebaran',
    'description' => 'Spesial Lebaran! Diskon hingga 50%',
    'banner_image' => 'promos/lebaran-2025.jpg',
    'start_date' => '2025-04-01',
    'end_date' => '2025-04-15',
    'is_active' => true,
    'created_by' => auth()->id(),
]);
```

### Get Active Promos

```php
// Semua promo aktif
$activePromos = Promo::active()->get();

// Promo yang sedang berjalan (dalam periode)
$ongoingPromos = Promo::ongoing()->get();

// Check validity
if ($promo->isValid()) {
    echo "Promo masih berlaku!";
}
```

### Update Company Profile

```php
$company = CompanyProfile::getProfile();
$company->update([
    'about_us' => 'Deskripsi baru...',
    'whatsapp' => '081234567890',
    'social_media' => [
        'instagram' => 'https://instagram.com/dimsumlicious_new',
        'facebook' => 'https://facebook.com/dimsumlicious',
    ],
]);
```

---

## 📁 File Locations

### Migrations

```
database/migrations/
├── 2025_11_11_214459_create_promos_table.php
└── 2025_11_11_214502_create_company_profile_table.php
```

### Models

```
app/Models/
├── Promo.php (with scopes & methods)
└── CompanyProfile.php (with singleton pattern)
```

### Seeders

```
database/seeders/
├── PromoSeeder.php (3 sample promos)
└── CompanyProfileSeeder.php (1 company profile)
```

---

## ✅ Checklist

-   [x] Migration promos dibuat
-   [x] Migration company_profile dibuat
-   [x] Model Promo dengan relasi & scopes
-   [x] Model CompanyProfile dengan singleton
-   [x] Update User model untuk relasi promos
-   [x] PromoSeeder dengan 3 data sample
-   [x] CompanyProfileSeeder dengan data default
-   [x] Update DatabaseSeeder
-   [x] Migration berhasil dijalankan
-   [x] Seeder berhasil dijalankan
-   [x] Dokumentasi lengkap

---

## 🎯 Next Steps

1. **Create Controllers**
    - PromoController (CRUD)
    - CompanyProfileController (Edit only)
2. **Create Views**
    - Admin: Promo management page
    - Admin: Company profile edit page
    - Staff: Promo management page (limited)
    - Homepage: Display promos & company info
3. **Create Routes**
    - Admin routes (full access)
    - Staff routes (limited access)
4. **Storage Setup**
    - Directory untuk promo banners: `storage/app/public/promos/`
    - Directory untuk company assets: `storage/app/public/company/`

---

## 💡 Design Notes

### Why Simple Structure?

1. **Promos Table**

    - Minimal columns untuk kemudahan management
    - Banner image opsional (bisa pakai default)
    - Date range untuk auto-activate/deactivate
    - Created_by untuk tracking

2. **Company Profile Table**
    - Singleton pattern (hanya 1 record)
    - Tidak perlu banyak kolom, fokus ke info penting
    - Social media pakai JSON untuk fleksibilitas
    - Mudah di-edit admin tanpa kompleksitas

### Homepage Display

-   Promo section: Tampilkan 2-3 promo ongoing
-   Company section: Ambil dari company_profile
-   Simple & clean, tidak overload

---

**Generated:** 2025-11-12  
**Status:** ✅ COMPLETED  
**Laravel Version:** 11.x  
**Database:** MySQL

🎉 **Fitur Promosi & Company Profile sudah siap digunakan!**
