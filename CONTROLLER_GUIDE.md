# 🎮 Controller Structure - Dimsumlicious

Dokumentasi lengkap struktur controller yang telah dipisah berdasarkan fitur/modul.

---

## 📁 Struktur Controller

```
app/Http/Controllers/
├── HomeController.php          → Homepage & halaman public
├── AuthController.php          → Login & Logout
├── DashboardController.php     → Dashboard admin/staff
├── ProductController.php       → Manajemen produk
├── CategoryController.php      → Manajemen kategori
├── StaffController.php         → Manajemen staff (admin only)
├── ReportController.php        → Laporan penjualan & stok
├── PromoController.php         → Manajemen promo
├── ProfileController.php       → Profile user
└── CompanyProfileController.php → Company profile (admin only)
```

---

## 🏠 HomeController

**Purpose:** Menangani halaman-halaman public/guest (user layout)

### Methods:

-   `index()` - Homepage
-   `products()` - Katalog produk untuk user
-   `about()` - Halaman tentang kami
-   `contact()` - Halaman kontak
-   `promo()` - Halaman promo untuk user

### Routes:

```php
GET  /              → home
GET  /products      → user.products
GET  /about         → user.about
GET  /contact       → user.contact
GET  /promo         → user.promo
```

---

## 🔐 AuthController

**Purpose:** Menangani autentikasi (login/logout)

### Methods:

-   `showLoginForm()` - Tampilkan form login
-   `login()` - Proses login
-   `logout()` - Proses logout

### Routes:

```php
GET   /login        → login
POST  /login        → login.process
POST  /logout       → logout
```

---

## 📊 DashboardController

**Purpose:** Dashboard utama untuk admin/staff

### Methods:

-   `index($username)` - Tampilkan dashboard dengan stats, charts, dan aktivitas terbaru

### Routes:

```php
GET  /dashboard/{username}  → dashboard
```

### Data yang ditampilkan:

-   Stats: total produk, stok rendah, penjualan, revenue
-   Chart: penjualan bulanan
-   Recent activities: log aktivitas terbaru

---

## 📦 ProductController

**Purpose:** CRUD manajemen produk dimsum

### Methods:

-   `index($username)` - List semua produk
-   `create($username)` - Form tambah produk
-   `store($username)` - Simpan produk baru
-   `edit($username, $id)` - Form edit produk
-   `update($username, $id)` - Update produk
-   `destroy($username, $id)` - Hapus produk

### Routes:

```php
GET     /products/{username}              → products.index
GET     /products/{username}/create       → products.create
POST    /products/{username}              → products.store
GET     /products/{username}/{id}/edit    → products.edit
PUT     /products/{username}/{id}         → products.update
DELETE  /products/{username}/{id}         → products.destroy
```

### Data yang dikelola:

-   Nama produk
-   Kategori
-   Harga
-   Stok
-   Status (Available/Low Stock/Out of Stock)
-   Last restock date
-   Image

---

## 🏷️ CategoryController

**Purpose:** CRUD manajemen kategori produk

### Methods:

-   `index($username)` - List semua kategori
-   `store($username)` - Simpan kategori baru
-   `update($username, $id)` - Update kategori
-   `destroy($username, $id)` - Hapus kategori

### Routes:

```php
GET     /categories/{username}        → categories.index
POST    /categories/{username}        → categories.store
PUT     /categories/{username}/{id}   → categories.update
DELETE  /categories/{username}/{id}   → categories.destroy
```

### Kategori default:

-   Dimsum
-   Dimsum Goreng
-   Pangsit
-   Bakpao
-   Lumpia

---

## 👥 StaffController

**Purpose:** CRUD manajemen staff (khusus admin)

### Methods:

-   `index($username)` - List semua staff
-   `store($username)` - Tambah staff baru
-   `update($username, $id)` - Update data staff
-   `destroy($username, $id)` - Hapus staff

### Routes:

```php
GET     /staff/{username}        → staff.index
POST    /staff/{username}        → staff.store
PUT     /staff/{username}/{id}   → staff.update
DELETE  /staff/{username}/{id}   → staff.destroy
```

### Data yang dikelola:

-   Name
-   Email
-   Role (Admin/Staff)
-   Phone
-   Join date
-   Status

**⚠️ Note:** Hanya admin yang bisa akses fitur ini!

---

## 📈 ReportController

**Purpose:** Generate laporan penjualan dan stok

### Methods:

-   `index($username)` - Tampilkan dashboard laporan
-   `generateSales($username)` - Generate laporan penjualan (PDF)
-   `generateStock($username)` - Generate laporan stok (PDF)

### Routes:

```php
GET   /reports/{username}        → reports.index
POST  /reports/{username}/sales  → reports.sales
POST  /reports/{username}/stock  → reports.stock
```

### Laporan yang tersedia:

-   Laporan penjualan (harian/mingguan/bulanan)
-   Laporan stok produk
-   Top selling products
-   Revenue growth

---

## 🎁 PromoController

**Purpose:** CRUD manajemen promo/diskon

### Methods:

-   `index($username)` - List semua promo
-   `store($username)` - Tambah promo baru
-   `update($username, $id)` - Update promo
-   `destroy($username, $id)` - Hapus promo

### Routes:

```php
GET     /promos/{username}        → promos.index
POST    /promos/{username}        → promos.store
PUT     /promos/{username}/{id}   → promos.update
DELETE  /promos/{username}/{id}   → promos.destroy
```

### Data yang dikelola:

-   Title
-   Description
-   Discount percentage
-   Start date
-   End date
-   Status (active/expired)
-   Image

---

## 👤 ProfileController

**Purpose:** Manajemen profile user

### Methods:

-   `show($username)` - Tampilkan profile
-   `update($username)` - Update profile
-   `updatePassword($username)` - Update password

### Routes:

```php
GET  /profile/{username}           → profile.show
PUT  /profile/{username}           → profile.update
PUT  /profile/{username}/password  → profile.update-password
```

### Data profile:

-   Name
-   Email
-   Role
-   Phone
-   Address
-   Bio
-   Avatar
-   Preferences (theme, language, notifications)

---

## 🏢 CompanyProfileController

**Purpose:** Manajemen company profile (khusus admin)

### Methods:

-   `index($username)` - Tampilkan company profile
-   `update($username)` - Update company profile

### Routes:

```php
GET  /company-profile/{username}  → company-profile.index
PUT  /company-profile/{username}  → company-profile.update
```

### Data yang dikelola:

-   Company name
-   Tagline
-   Description
-   Address
-   Contact info (phone, email, WhatsApp)
-   Operating hours
-   Social media
-   Logo & hero image

**⚠️ Note:** Hanya admin yang bisa edit company profile!

---

## 🎯 Route Naming Convention

Semua routes menggunakan named routes untuk memudahkan redirect:

```php
// Contoh penggunaan
return redirect()->route('products.index', ['username' => $username]);
return redirect()->route('dashboard', ['username' => $username]);
```

---

## 🔒 Access Control

### Public Routes (Guest):

-   Homepage, Products, About, Contact, Promo
-   Login page

### Staff Routes:

-   Dashboard
-   Product Management
-   Category Management
-   Reports
-   Promo Management
-   Profile

### Admin Only Routes:

-   Staff Management
-   Company Profile

---

## 📝 TODO - Implementasi Database

Semua controller saat ini menggunakan **mock data**. Untuk implementasi database:

1. ✅ Buat migration untuk setiap tabel
2. ✅ Buat model untuk setiap entitas
3. ✅ Replace mock data dengan Eloquent queries
4. ✅ Implement validation
5. ✅ Implement authentication & authorization
6. ✅ Add middleware untuk role-based access

---

## 🚀 Next Steps

1. **Create Views** - Buat view untuk setiap fitur yang belum ada
2. **Database Integration** - Implementasi database & models
3. **Authentication** - Setup Laravel authentication
4. **Middleware** - Implement role-based middleware (admin/staff)
5. **File Upload** - Implement image upload untuk produk & promo
6. **API** - (Optional) Create REST API untuk mobile app

---

**Happy Coding! 🎉**
