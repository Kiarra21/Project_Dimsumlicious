# 🔐 Role Management System - Dimsumlicious

Dokumentasi lengkap sistem manajemen role dan permission untuk Dimsumlicious.

---

## 📋 Roles & Permissions

### 1. 👑 **ADMIN** (Administrator)

Full access ke semua fitur sistem.

#### Permissions:

**Product Management:**

-   ✅ `product.view` - Lihat produk
-   ✅ `product.create` - Tambah produk
-   ✅ `product.edit` - Edit produk
-   ✅ `product.delete` - Hapus produk
-   ✅ `product.manage_status` - Ubah status ketersediaan
-   ✅ `product.upload_photo` - Upload foto produk

**Category Management:**

-   ✅ `category.view` - Lihat kategori
-   ✅ `category.create` - Tambah kategori
-   ✅ `category.edit` - Edit kategori
-   ✅ `category.delete` - Hapus kategori

**Staff Management:**

-   ✅ `staff.view` - Lihat staff
-   ✅ `staff.create` - Tambah staff
-   ✅ `staff.edit` - Edit staff
-   ✅ `staff.delete` - Hapus staff

**Reports & Finance:**

-   ✅ `report.view` - Lihat laporan
-   ✅ `report.sales` - Laporan penjualan
-   ✅ `report.finance` - Laporan keuangan
-   ✅ `report.download` - Download laporan
-   ✅ `report.transactions` - Lihat transaksi
-   ✅ `report.profit` - Lihat keuntungan
-   ✅ `report.charts` - Lihat grafik

**Promo Management:**

-   ✅ `promo.view` - Lihat promo
-   ✅ `promo.create` - Tambah promo
-   ✅ `promo.edit` - Edit promo
-   ✅ `promo.delete` - Hapus promo
-   ✅ `promo.upload_banner` - Upload banner
-   ✅ `promo.manage_status` - Ubah status promo

**Company Profile:**

-   ✅ `company.view` - Lihat company profile
-   ✅ `company.edit` - Edit company profile
-   ✅ `company.edit_description` - Edit deskripsi
-   ✅ `company.edit_location` - Edit lokasi
-   ✅ `company.edit_contact` - Edit kontak
-   ✅ `company.upload_media` - Upload foto/video

---

### 2. 👨‍💼 **STAFF** (Staff)

Limited access untuk staff members.

#### Permissions:

**Product Management (Limited):**

-   ✅ `product.view` - Lihat produk
-   ✅ `product.create` - Tambah produk
-   ✅ `product.edit` - Edit produk
-   ✅ `product.delete` - Hapus produk
-   ✅ `product.manage_status` - Update stok/status
-   ✅ `product.upload_photo` - Upload foto produk

**Promo Management:**

-   ✅ `promo.view` - Lihat promo
-   ✅ `promo.create` - Tambah promo
-   ✅ `promo.edit` - Edit promo
-   ✅ `promo.upload_banner` - Upload banner

**Sales Monitoring (No Finance Access):**

-   ✅ `report.view` - Lihat laporan
-   ✅ `report.transactions` - Lihat transaksi
-   ❌ `report.finance` - **TIDAK** bisa akses laporan keuangan
-   ❌ `report.download` - **TIDAK** bisa download laporan
-   ❌ `report.profit` - **TIDAK** bisa lihat keuntungan

**Restrictions:**

-   ❌ Tidak bisa mengelola staff
-   ❌ Tidak bisa edit company profile
-   ❌ Tidak bisa hapus promo (hanya admin)

---

### 3. 👤 **USER** (User Biasa)

Regular user dengan akses basic.

#### Permissions:

**View Only:**

-   ✅ `product.view` - Lihat produk
-   ✅ `promo.view` - Lihat promo
-   ✅ `company.view` - Lihat company profile

**Shopping (Future Feature):**

-   ✅ `cart.add` - Tambah ke keranjang
-   ✅ `cart.view` - Lihat keranjang
-   ✅ `order.create` - Buat pesanan
-   ✅ `order.view` - Lihat pesanan

---

## 🗄️ Database Structure

### Table: `roles`

```sql
- id (bigint, primary key)
- name (string, unique) → 'admin', 'staff', 'user'
- display_name (string) → 'Administrator', 'Staff', 'User'
- description (text, nullable)
- permissions (json, nullable) → Array of permissions
- created_at (timestamp)
- updated_at (timestamp)
```

### Table: `users` (Updated)

```sql
- id (bigint, primary key)
- name (string)
- email (string, unique)
- password (string)
- role_id (bigint, foreign key → roles.id)
- phone (string, nullable)
- address (text, nullable)
- avatar (string, nullable)
- is_active (boolean, default: true)
- last_login_at (timestamp, nullable)
- email_verified_at (timestamp, nullable)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

---

## 🔧 Model Methods

### User Model

```php
// Check role
$user->hasRole('admin');
$user->isAdmin();
$user->isStaff();
$user->isUser();

// Check permission
$user->hasPermission('product.create');

// Get role name
$user->getRoleName(); // Returns: 'Administrator', 'Staff', 'User'
```

### Role Model

```php
// Check permission
$role->hasPermission('product.view');

// Constants
Role::ADMIN // 'admin'
Role::STAFF // 'staff'
Role::USER  // 'user'
```

---

## 🛡️ Middleware Usage

### 1. CheckRole Middleware

Memeriksa apakah user memiliki role tertentu.

```php
// Single role
Route::middleware(['role:admin'])->group(function () {
    // Only admin can access
});

// Multiple roles
Route::middleware(['role:admin,staff'])->group(function () {
    // Admin OR Staff can access
});
```

### 2. CheckPermission Middleware

Memeriksa apakah user memiliki permission spesifik.

```php
// Single permission
Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware('permission:product.create');

// Multiple permissions (ALL required)
Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->middleware('permission:product.delete,product.manage');
```

---

## 🚦 Route Protection Examples

### Admin Only Routes

```php
Route::prefix('staff/{username}')
    ->middleware(['role:admin'])
    ->name('staff.')
    ->group(function () {
        Route::get('/', [StaffController::class, 'index'])
            ->middleware('permission:staff.view');
    });
```

### Admin & Staff Routes

```php
Route::prefix('products/{username}')
    ->middleware(['role:admin,staff'])
    ->name('products.')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])
            ->middleware('permission:product.view');
        Route::post('/', [ProductController::class, 'store'])
            ->middleware('permission:product.create');
    });
```

### Public Routes (No Protection)

```php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('user.products');
```

---

## 🔄 Seeding Data

Run seeder untuk create default roles:

```bash
php artisan db:seed --class=RoleSeeder
```

Roles yang akan dibuat:

1. **Admin** - dengan semua permissions
2. **Staff** - dengan limited permissions
3. **User** - dengan basic permissions

---

## 📝 How to Use

### 1. **Assign Role to User**

```php
$user = User::find(1);
$adminRole = Role::where('name', 'admin')->first();
$user->role_id = $adminRole->id;
$user->save();
```

### 2. **Check Access in Controller**

```php
public function index()
{
    if (!auth()->user()->hasPermission('product.view')) {
        abort(403, 'Unauthorized action.');
    }

    // Your code here
}
```

### 3. **Check Access in Blade**

```blade
@can('product.create')
    <button>Tambah Produk</button>
@endcan

@if(auth()->user()->isAdmin())
    <a href="{{ route('staff.index') }}">Kelola Staff</a>
@endif
```

---

## ⚙️ Configuration

### Middleware Aliases (bootstrap/app.php)

```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
    'permission' => \App\Http\Middleware\CheckPermission::class,
]);
```

---

## 🚀 Migration Commands

```bash
# Run migrations
php artisan migrate

# Seed roles
php artisan db:seed --class=RoleSeeder

# Fresh migration with seed
php artisan migrate:fresh --seed
```

---

## 📊 Permission Matrix

| Feature                 | Admin | Staff | User |
| ----------------------- | ----- | ----- | ---- |
| **Product Management**  |
| View Products           | ✅    | ✅    | ✅   |
| Add Product             | ✅    | ✅    | ❌   |
| Edit Product            | ✅    | ✅    | ❌   |
| Delete Product          | ✅    | ✅    | ❌   |
| **Category Management** |
| View Categories         | ✅    | ❌    | ✅   |
| Manage Categories       | ✅    | ❌    | ❌   |
| **Staff Management**    |
| View Staff              | ✅    | ❌    | ❌   |
| Manage Staff            | ✅    | ❌    | ❌   |
| **Reports**             |
| View Transactions       | ✅    | ✅    | ❌   |
| Finance Reports         | ✅    | ❌    | ❌   |
| Download Reports        | ✅    | ❌    | ❌   |
| **Promo Management**    |
| View Promos             | ✅    | ✅    | ✅   |
| Manage Promos           | ✅    | ✅    | ❌   |
| Delete Promos           | ✅    | ❌    | ❌   |
| **Company Profile**     |
| View Profile            | ✅    | ❌    | ✅   |
| Edit Profile            | ✅    | ❌    | ❌   |

---

## 🔒 Security Features

1. ✅ **Role-based Access Control (RBAC)**
2. ✅ **Permission-based Authorization**
3. ✅ **Active Account Check** - Inactive users automatically logged out
4. ✅ **Authentication Required** - All protected routes require login
5. ✅ **Granular Permissions** - Fine-grained access control
6. ✅ **Middleware Protection** - Routes protected at middleware level

---

## 📱 Next Steps

1. ✅ Create default admin account
2. ✅ Implement authentication system
3. ✅ Add role assignment in staff management
4. ✅ Create permission checking in views
5. ✅ Add audit logging for role changes
6. ✅ Implement role-based dashboard views

---

**Happy Coding! 🎉**
