# DASAR TEORI

## Project Dimsumlicious - Sistem Informasi Manajemen Dimsum

---

## 1. Konsep Dasar Sistem Informasi

### 1.1 Sistem Informasi Berbasis Web

Sistem informasi berbasis web adalah aplikasi yang diakses melalui web browser dan berjalan di web server. Project Dimsumlicious merupakan sistem informasi berbasis web yang dirancang untuk mengelola bisnis penjualan dimsum, mencakup:

-   **Manajemen Produk**: Pengelolaan data produk dimsum dengan kategori
-   **Manajemen Promosi**: Sistem diskon dan promosi berbasis waktu
-   **Manajemen Pengguna**: Role-based access control (Admin, Staff, User)
-   **Company Profile**: Pengelolaan informasi perusahaan
-   **Dashboard**: Tampilan statistik dan monitoring bisnis

Keunggulan sistem berbasis web:

-   Dapat diakses dari mana saja dengan koneksi internet
-   Multi-platform (desktop, tablet, mobile)
-   Mudah di-update tanpa instalasi di client
-   Centralized data management

### 1.2 Model Arsitektur Client-Server

Dimsumlicious mengimplementasikan arsitektur client-server dengan pola three-tier:

**Presentation Layer (Client)**

-   Web Browser menampilkan HTML, CSS, JavaScript
-   User Interface menggunakan Tailwind CSS
-   JavaScript untuk interaktivitas (modals, form validation, real-time calculation)

**Application Layer (Server)**

-   Laravel Framework (PHP) sebagai business logic
-   MVC Pattern untuk separation of concerns
-   Authentication & Authorization middleware
-   RESTful routing untuk handle HTTP requests

**Data Layer (Database)**

-   MySQL sebagai Relational Database Management System
-   Eloquent ORM untuk data abstraction
-   Migration untuk version control database schema

**Flow komunikasi:**

```
Client Browser → HTTP Request → Laravel Router → Controller →
Model (Eloquent) → Database → Response → View (Blade) →
HTML/CSS/JS → Client Browser
```

### 1.3 Konsep Database Relational

Database relational menyimpan data dalam bentuk tabel dengan relasi antar tabel. Pada Dimsumlicious:

**Tabel Utama:**

-   `users`: Data pengguna (admin, staff, customer)
-   `roles`: Role untuk authorization
-   `products`: Data produk dimsum
-   `categories`: Kategori produk
-   `promos`: Data promosi dan diskon
-   `orders`: Data pesanan
-   `order_items`: Detail item pesanan
-   `carts`: Keranjang belanja
-   `company_profile`: Informasi perusahaan

**Jenis Relasi:**

1. **One-to-Many**:

    - User → Orders (satu user punya banyak order)
    - Category → Products (satu kategori punya banyak produk)
    - Promo → Products (satu promo bisa dipakai banyak produk)

2. **Many-to-One (Belongs To)**:

    - Product → Category
    - Order → User
    - Product → Promo

3. **One-to-One**:
    - Company Profile (singleton record)

**Contoh implementasi relasi dalam Laravel:**

```php
// Model Product.php
public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}

public function promo(): BelongsTo {
    return $this->belongsTo(Promo::class);
}
```

**Foreign Key Constraints:**

-   Menjaga referential integrity
-   CASCADE untuk delete child records
-   SET NULL untuk optional relationships

---

## 2. Landasan Teknologi Backend

### 2.1 Bahasa Pemrograman PHP

PHP (Hypertext Preprocessor) adalah bahasa server-side scripting yang digunakan untuk web development. Versi yang digunakan: PHP 8.x

**Karakteristik PHP dalam project:**

1. **Server-Side Processing**

```php
// Controller memproses request di server
public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    Product::create($validated);
}
```

2. **Dynamic Content Generation**

-   PHP menggenerate HTML secara dinamis berdasarkan data database
-   Session management untuk authentication
-   File upload handling (produk images, company logo)

3. **Database Integration**

-   PDO untuk database connection
-   Prepared statements untuk keamanan (SQL injection prevention)

### 2.2 Konsep Framework

Framework adalah kerangka kerja yang menyediakan struktur dan tools untuk mempercepat development. Keuntungan menggunakan framework:

**1. Struktur Terorganisir**

-   Folder structure yang konsisten
-   Separation of concerns (MVC)
-   Code reusability

**2. Built-in Features**

-   Authentication & Authorization
-   Database abstraction (ORM)
-   Routing system
-   Templating engine
-   Security features

**3. Best Practices**

-   Coding standards
-   Design patterns
-   Testing support

### 2.3 Framework Laravel - Konsep MVC

Laravel adalah PHP framework modern yang mengikuti pola MVC (Model-View-Controller).

**Arsitektur MVC di Dimsumlicious:**

**MODEL** - Representasi data dan business logic

```php
// app/Models/Product.php
class Product extends Model {
    protected $fillable = ['name', 'price', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getFinalPrice() {
        return $this->has_discount ?
               $this->discount_price : $this->price;
    }
}
```

**VIEW** - Presentation layer (UI)

```blade
{{-- resources/views/admin/products/index.blade.php --}}
@foreach($products as $product)
    <div class="product-card">
        <h3>{{ $product->name }}</h3>
        <p>Rp {{ number_format($product->price) }}</p>
    </div>
@endforeach
```

**CONTROLLER** - Request handler dan orchestrator

```php
// app/Http/Controllers/ProductController.php
class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request) {
        $validated = $request->validate([...]);
        Product::create($validated);
        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil ditambahkan');
    }
}
```

**Request Flow:**

1. User akses URL → Router
2. Router panggil Controller method
3. Controller ambil data dari Model
4. Model query ke Database
5. Controller kirim data ke View
6. View render HTML
7. Response dikirim ke Browser

---

## 3. Konsep Inti Laravel yang Diimplementasikan

### 3.1 Routing dan Controller

**Routing** adalah mekanisme untuk map URL ke controller method.

**Implementasi di `routes/web.php`:**

```php
// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes dengan middleware
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product CRUD
    Route::resource('products', ProductController::class);

    // Promo management
    Route::resource('promos', PromoController::class);

    // Company Profile
    Route::get('/company-profile', [CompanyProfileController::class, 'index'])
         ->name('company-profile.index');
    Route::put('/company-profile', [CompanyProfileController::class, 'update'])
         ->name('company-profile.update');
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->group(function() {
    Route::get('/dashboard', [StaffDashboardController::class, 'index']);
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store']);
});
```

**Jenis Route:**

-   GET: Menampilkan data/form
-   POST: Submit data baru
-   PUT/PATCH: Update data
-   DELETE: Hapus data

**Route Middleware:**

-   `auth`: Memastikan user sudah login
-   `role:admin`: Memastikan user adalah admin
-   `role:staff`: Memastikan user adalah staff

**Controller Methods:**

```php
class ProductController extends Controller {
    public function index() { }      // GET /products - List
    public function create() { }     // GET /products/create - Form
    public function store() { }      // POST /products - Save
    public function show($id) { }    // GET /products/{id} - Detail
    public function edit($id) { }    // GET /products/{id}/edit - Edit Form
    public function update($id) { }  // PUT /products/{id} - Update
    public function destroy($id) { } // DELETE /products/{id} - Delete
}
```

### 3.2 Model dan Eloquent ORM

**Eloquent ORM** adalah implementasi Active Record pattern untuk database interaction.

**Definisi Model:**

```php
// app/Models/Product.php
class Product extends Model {
    // Nama tabel (otomatis 'products')
    protected $table = 'products';

    // Mass assignment protection
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'promo_id', 'has_discount', 'discount_price',
        'stock', 'image', 'is_available', 'is_featured'
    ];

    // Type casting
    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'has_discount' => 'boolean',
        'is_available' => 'boolean',
    ];

    // Relationships
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function promo(): BelongsTo {
        return $this->belongsTo(Promo::class);
    }

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    // Custom methods
    public function getFinalPrice() {
        return $this->has_discount && $this->discount_price
               ? $this->discount_price
               : $this->price;
    }
}
```

**Operasi CRUD dengan Eloquent:**

**Create:**

```php
// Cara 1: Mass assignment
Product::create([
    'name' => 'Dimsum Ayam',
    'price' => 25000,
    'category_id' => 1
]);

// Cara 2: Manual
$product = new Product;
$product->name = 'Dimsum Ayam';
$product->price = 25000;
$product->save();
```

**Read:**

```php
// Get all
$products = Product::all();

// Get dengan filter
$products = Product::where('is_available', true)->get();

// Get dengan relasi (Eager Loading)
$products = Product::with('category', 'promo')->get();

// Pagination
$products = Product::paginate(10);

// Find by ID
$product = Product::find($id);
$product = Product::findOrFail($id); // throw 404 jika tidak ada
```

**Update:**

```php
$product = Product::find($id);
$product->update([
    'price' => 30000,
    'stock' => 50
]);
```

**Delete:**

```php
$product = Product::find($id);
$product->delete();

// Atau langsung
Product::destroy($id);
```

**Query Builder Advanced:**

```php
// Join dengan relasi
$products = Product::with(['category', 'promo'])
    ->where('is_available', true)
    ->where('stock', '>', 0)
    ->orderBy('created_at', 'desc')
    ->paginate(10);

// Conditional query
$query = Product::query();
if ($search) {
    $query->where('name', 'like', "%{$search}%");
}
if ($categoryId) {
    $query->where('category_id', $categoryId);
}
$products = $query->get();
```

### 3.3 Blade Templating Engine

**Blade** adalah template engine Laravel untuk generate dynamic HTML.

**1. Layout Master (Inheritance)**

```blade
{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Dimsumlicious Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @include('components.sidebar')

    <main>
        @yield('content')
    </main>

    @stack('modals')
    @stack('scripts')
</body>
</html>
```

**2. Child View**

```blade
{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <table>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price) }}</td>
                    <td>
                        @if($product->has_discount)
                            <span class="badge-discount">
                                {{ $product->promo->discount }}% OFF
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $products->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        // Custom JavaScript
    </script>
@endpush
```

**3. Blade Directives:**

**Control Structures:**

```blade
@if($user->role->name === 'admin')
    <button>Delete</button>
@elseif($user->role->name === 'staff')
    <button>Edit</button>
@else
    <span>View Only</span>
@endif

@foreach($products as $product)
    <div>{{ $product->name }}</div>
@endforeach

@forelse($products as $product)
    <div>{{ $product->name }}</div>
@empty
    <p>Tidak ada produk</p>
@endforelse
```

**Authentication:**

```blade
@auth
    <p>Welcome, {{ auth()->user()->name }}</p>
@endauth

@guest
    <a href="/login">Login</a>
@endguest
```

**Components:**

```blade
{{-- Include partial view --}}
@include('components.modal', ['title' => 'Add Product'])

{{-- Component dengan slot --}}
<x-alert type="success">
    Data berhasil disimpan
</x-alert>
```

**Data Escaping:**

```blade
{{-- Escaped (safe dari XSS) --}}
{{ $product->name }}

{{-- Unescaped (hati-hati!) --}}
{!! $htmlContent !!}

{{-- JSON untuk JavaScript --}}
<script>
    const product = @json($product);
</script>
```

---

## 4. Landasan Teknologi Frontend

### 4.1 HTML & CSS

**HTML5** - Struktur markup semantic:

```html
<!-- Semantic HTML dalam Dimsumlicious -->
<header>
    <nav class="sidebar">
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/products">Produk</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="stats-cards">
        <article class="card">
            <h3>Total Produk</h3>
            <p class="value">{{ $stats['total_products'] }}</p>
        </article>
    </section>

    <section class="products-grid">
        <!-- Product cards -->
    </section>
</main>

<footer>
    <p>&copy; 2025 Dimsumlicious</p>
</footer>
```

**CSS3** - Modern styling:

-   Flexbox untuk layout
-   Grid untuk responsive design
-   Animations dan transitions
-   Media queries untuk mobile-first

### 4.2 JavaScript dan Library JS

**Vanilla JavaScript** digunakan untuk:

**1. Modal Management**

```javascript
function openAddModal() {
    document.getElementById("productModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("productModal").style.display = "none";
}
```

**2. Form Validation**

```javascript
function calculateDiscount() {
    const price = parseFloat(document.getElementById("price").value);
    const discount = parseFloat(document.getElementById("discount").value);

    if (price > 0 && discount > 0) {
        const finalPrice = price - (price * discount) / 100;
        document.getElementById("finalPrice").textContent =
            finalPrice.toLocaleString("id-ID");
    }
}
```

**3. Dynamic Content**

```javascript
function openEditModal(product) {
    document.querySelector('[name="name"]').value = product.name;
    document.querySelector('[name="price"]').value = product.price;
    document.querySelector('[name="promo_id"]').value = product.promo_id || "";

    calculateDiscount();
    document.getElementById("productModal").style.display = "flex";
}
```

**4. Image Preview**

```javascript
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("previewImg").src = e.target.result;
            document.getElementById("imagePreview").classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
}
```

### 4.3 Tailwind CSS Framework

**Tailwind CSS** adalah utility-first CSS framework yang digunakan di Dimsumlicious.

**Keuntungan Tailwind:**

-   Rapid development dengan utility classes
-   Konsisten design system
-   Responsive design built-in
-   Small production bundle (PurgeCSS)

**Implementasi:**

**1. Configuration (`tailwind.config.js`)**

```javascript
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                primary: "#72BF78",
                secondary: "#A0D683",
                accent: "#D3EE98",
            },
        },
    },
};
```

**2. Utility Classes**

```blade
<!-- Layout -->
<div class="container mx-auto px-4 py-6">
    <!-- Grid System -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card Component -->
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-xl transition-shadow">
            <h3 class="text-lg font-bold text-gray-900 mb-2">
                {{ $product->name }}
            </h3>
            <p class="text-sm text-gray-600 line-clamp-3">
                {{ $product->description }}
            </p>

            <!-- Responsive Button -->
            <button class="w-full sm:w-auto px-4 py-2 bg-primary text-white
                           rounded-lg hover:bg-opacity-90 transition-colors">
                Tambah ke Keranjang
            </button>
        </div>

    </div>
</div>

<!-- Responsive Sidebar -->
<aside class="hidden md:block w-64 bg-white shadow-lg">
    <!-- Sidebar content -->
</aside>

<!-- Modal with Backdrop -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal content -->
    </div>
</div>
```

**3. Custom Components**

```blade
<!-- Alert Component -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700
                px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="..."/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Badge Component -->
@if($product->has_discount)
    <span class="px-3 py-1 text-xs font-semibold rounded-full
                 bg-yellow-400 text-gray-900">
        {{ $product->promo->discount }}% OFF
    </span>
@endif
```

**4. Responsive Design**

```blade
<!-- Mobile-First Approach -->
<nav class="flex flex-col sm:flex-row gap-2 sm:gap-4">
    <a class="text-sm sm:text-base">Dashboard</a>
    <a class="text-sm sm:text-base">Produk</a>
</nav>

<!-- Breakpoints: sm (640px), md (768px), lg (1024px), xl (1280px) -->
```

---

## 5. Konsep CRUD (Create, Read, Update, Delete)

CRUD adalah operasi dasar dalam aplikasi database. Implementasi di Dimsumlicious:

### 5.1 CREATE - Menambah Data

**Controller:**

```php
public function store(Request $request) {
    // 1. Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'promo_id' => 'nullable|exists:promos,id',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2. Handle file upload
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
                                      ->store('products', 'public');
    }

    // 3. Generate slug
    $validated['slug'] = Str::slug($request->name);

    // 4. Auto calculate discount
    if ($request->promo_id) {
        $promo = Promo::find($request->promo_id);
        if ($promo && $promo->discount > 0) {
            $validated['has_discount'] = true;
            $validated['discount_price'] = $request->price -
                ($request->price * $promo->discount / 100);
        }
    }

    // 5. Save to database
    Product::create($validated);

    // 6. Redirect dengan flash message
    return redirect()->route('products.index')
                    ->with('success', 'Produk berhasil ditambahkan!');
}
```

**View (Form):**

```blade
<form action="{{ route('products.store') }}" method="POST"
      enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" required>
    <select name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="number" name="price" required>
    <select name="promo_id">
        <option value="">Tanpa Promo</option>
        @foreach($promos as $promo)
            <option value="{{ $promo->id }}">
                {{ $promo->title }} ({{ $promo->discount }}% OFF)
            </option>
        @endforeach
    </select>
    <input type="file" name="image" accept="image/*">

    <button type="submit">Simpan</button>
</form>
```

### 5.2 READ - Menampilkan Data

**List dengan Pagination:**

```php
public function index(Request $request) {
    $search = $request->get('search');

    $products = Product::with(['category', 'promo'])
        ->when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    $categories = Category::where('is_active', true)->get();
    $promos = Promo::where('is_active', true)
                   ->where('end_date', '>=', now())
                   ->get();

    $stats = [
        'total_products' => Product::count(),
        'available_products' => Product::where('is_available', true)->count(),
        'low_stock' => Product::whereBetween('stock', [1, 5])->count(),
    ];

    return view('admin.products.index',
                compact('products', 'categories', 'promos', 'stats'));
}
```

**Detail Single Record:**

```php
public function show($id) {
    $product = Product::with(['category', 'promo', 'orderItems'])
                     ->findOrFail($id);

    return view('admin.products.show', compact('product'));
}
```

**View:**

```blade
@foreach($products as $product)
    <tr>
        <td>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">
            @endif
            {{ $product->name }}
        </td>
        <td>{{ $product->category->name }}</td>
        <td>
            @if($product->has_discount)
                <span class="line-through">
                    Rp {{ number_format($product->price) }}
                </span>
                <span class="text-green-600">
                    Rp {{ number_format($product->discount_price) }}
                </span>
            @else
                Rp {{ number_format($product->price) }}
            @endif
        </td>
        <td>{{ $product->stock }} pcs</td>
        <td>
            <button onclick="openEditModal({{ $product }})">Edit</button>
            <button onclick="deleteProduct({{ $product->id }})">Hapus</button>
        </td>
    </tr>
@endforeach

{{ $products->links() }}
```

### 5.3 UPDATE - Mengubah Data

**Controller:**

```php
public function update(Request $request, $id) {
    $product = Product::findOrFail($id);

    // Validasi
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'promo_id' => 'nullable|exists:promos,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle image update
    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $validated['image'] = $request->file('image')
                                      ->store('products', 'public');
    }

    // Update slug jika nama berubah
    $validated['slug'] = Str::slug($request->name);

    // Recalculate discount
    if ($request->promo_id) {
        $promo = Promo::find($request->promo_id);
        if ($promo && $promo->discount > 0) {
            $validated['has_discount'] = true;
            $validated['discount_price'] = $request->price -
                ($request->price * $promo->discount / 100);
        }
    } else {
        $validated['has_discount'] = false;
        $validated['discount_price'] = null;
        $validated['promo_id'] = null;
    }

    // Update database
    $product->update($validated);

    return redirect()->route('products.index')
                    ->with('success', 'Produk berhasil diupdate!');
}
```

**View (Edit Form):**

```blade
<form action="{{ route('products.update', $product->id) }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}" required>
    <input type="number" name="price" value="{{ $product->price }}" required>
    <select name="promo_id">
        <option value="">Tanpa Promo</option>
        @foreach($promos as $promo)
            <option value="{{ $promo->id }}"
                    {{ $product->promo_id == $promo->id ? 'selected' : '' }}>
                {{ $promo->title }}
            </option>
        @endforeach
    </select>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}">
    @endif
    <input type="file" name="image">

    <button type="submit">Update</button>
</form>
```

### 5.4 DELETE - Menghapus Data

**Controller:**

```php
public function destroy($id) {
    $product = Product::findOrFail($id);

    // Delete associated image
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // Delete from database
    $product->delete();

    return redirect()->route('products.index')
                    ->with('success', 'Produk berhasil dihapus!');
}
```

**View (JavaScript):**

```javascript
function deleteProduct(id) {
    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/products/" + id;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
```

**Soft Delete (Optional):**

```php
// Model dengan SoftDeletes trait
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;
}

// Migration
$table->softDeletes(); // adds deleted_at column

// Controller - Soft Delete
$product->delete(); // Set deleted_at timestamp

// Query termasuk soft deleted
$products = Product::withTrashed()->get();

// Restore
$product->restore();

// Permanent delete
$product->forceDelete();
```

---

## 6. Keamanan Website Dasar

### 6.1 Authentication (Autentikasi)

**Implementasi Laravel Authentication:**

```php
// Controller
public function login(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}

public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
```

**Password Hashing:**

```php
// Saat registrasi
User::create([
    'email' => $request->email,
    'password' => Hash::make($request->password), // Bcrypt hashing
]);

// Verifikasi
if (Hash::check($plainPassword, $user->password)) {
    // Password correct
}
```

### 6.2 Authorization (Otorisasi)

**Role-Based Access Control:**

```php
// Middleware untuk check role
// app/Http/Middleware/CheckRole.php
public function handle($request, Closure $next, ...$roles) {
    if (!auth()->check()) {
        return redirect('/login');
    }

    if (!in_array(auth()->user()->role->name, $roles)) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}

// Route dengan middleware role
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('products', ProductController::class);
    Route::resource('promos', PromoController::class);
});

Route::middleware(['auth', 'role:staff,admin'])->group(function() {
    Route::get('/products', [ProductController::class, 'index']);
});
```

**Blade Directives:**

```blade
@if(auth()->check() && auth()->user()->role->name === 'admin')
    <button onclick="deleteProduct()">Delete</button>
@endif

@can('delete', $product)
    <button>Delete</button>
@endcan
```

### 6.3 CSRF Protection

**Cross-Site Request Forgery Protection:**

```blade
<!-- Semua form POST/PUT/DELETE harus include CSRF token -->
<form method="POST" action="/products">
    @csrf
    <!-- Form fields -->
</form>

<!-- Untuk AJAX -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
```

Laravel otomatis generate dan verify CSRF token untuk setiap request.

### 6.4 SQL Injection Prevention

**Prepared Statements dengan Eloquent:**

```php
// AMAN - Eloquent ORM dengan parameter binding
$products = Product::where('category_id', $request->category_id)->get();

// AMAN - Query Builder
$products = DB::table('products')
              ->where('name', 'like', '%' . $search . '%')
              ->get();

// BAHAYA - Raw query tanpa binding
$products = DB::select("SELECT * FROM products WHERE name = '$search'");

// AMAN - Raw query dengan parameter binding
$products = DB::select("SELECT * FROM products WHERE name = ?", [$search]);
```

### 6.5 XSS (Cross-Site Scripting) Prevention

**Output Escaping:**

```blade
{{-- AMAN - Auto-escaped --}}
<p>{{ $product->name }}</p>
<!-- Output: <p>Dimsum &lt;script&gt;alert('xss')&lt;/script&gt;</p> -->

{{-- BAHAYA - Unescaped (hanya untuk trusted HTML) --}}
<div>{!! $htmlContent !!}</div>

{{-- AMAN - Untuk JSON --}}
<script>
    const data = @json($product); // Auto-escaped
</script>
```

### 6.6 Mass Assignment Protection

```php
// Model
class Product extends Model {
    // Whitelist - hanya field ini yang bisa mass assign
    protected $fillable = [
        'name', 'price', 'category_id', 'stock'
    ];

    // Blacklist - field ini tidak bisa mass assign
    protected $guarded = ['id', 'created_at', 'updated_at'];
}

// Controller - BAHAYA tanpa fillable
Product::create($request->all()); // Bisa inject field apapun

// AMAN - dengan fillable
Product::create($request->validated()); // Hanya validated fields
```

### 6.7 File Upload Security

```php
public function store(Request $request) {
    $validated = $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
    ]);

    // Generate unique filename
    $filename = time() . '_' . $request->file('image')->getClientOriginalName();

    // Store di storage/app/public
    $path = $request->file('image')->storeAs('products', $filename, 'public');

    // Jangan simpan langsung di public folder
    // Gunakan storage link: php artisan storage:link
}
```

### 6.8 Environment Variables

```php
// .env file - JANGAN commit ke Git
DB_DATABASE=dimsumlicious
DB_USERNAME=root
DB_PASSWORD=secret

APP_KEY=base64:generated_key
APP_DEBUG=false // PRODUCTION harus false
APP_URL=https://dimsumlicious.com

// Akses di code
$dbName = env('DB_DATABASE');
$appUrl = config('app.url');
```

### 6.9 HTTPS dan Secure Headers

```php
// Force HTTPS di production
// app/Providers/AppServiceProvider.php
public function boot() {
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
}

// Security Headers
// app/Http/Middleware/SecurityHeaders.php
public function handle($request, Closure $next) {
    $response = $next($request);

    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
    $response->headers->set('X-XSS-Protection', '1; mode=block');

    return $response;
}
```

### 6.10 Rate Limiting

```php
// Limit login attempts
Route::post('/login', [AuthController::class, 'login'])
     ->middleware('throttle:5,1'); // 5 attempts per 1 minute

// API rate limiting
Route::middleware('throttle:60,1')->group(function() {
    Route::get('/api/products', [ApiController::class, 'products']);
});
```

---

## Kesimpulan

Project Dimsumlicious dibangun dengan menerapkan konsep-konsep fundamental pengembangan web modern:

1. **Sistem Informasi Berbasis Web** dengan arsitektur client-server three-tier
2. **Database Relational** dengan proper normalization dan relationships
3. **Laravel Framework** dengan pola MVC untuk separation of concerns
4. **Eloquent ORM** untuk database abstraction dan data manipulation
5. **Blade Templating** untuk dynamic HTML generation
6. **Tailwind CSS** untuk rapid UI development
7. **CRUD Operations** sebagai dasar aplikasi data-driven
8. **Security Best Practices** untuk melindungi aplikasi dan data user

Dengan foundation yang solid ini, Dimsumlicious dapat dikembangkan lebih lanjut dengan fitur-fitur seperti:

-   Payment gateway integration
-   Real-time order tracking
-   Analytics dashboard
-   Mobile app API
-   Multi-language support
-   Advanced reporting

---

## Fitur Tambahan: Laporan Penjualan

### Deskripsi Fitur

Fitur laporan penjualan memberikan dashboard analitik komprehensif untuk admin dan staff dalam memantau performa bisnis. Laporan dapat difilter berdasarkan periode waktu (harian, mingguan, bulanan, tahunan, atau custom range).

### Komponen Laporan

**1. Statistik Utama:**

-   Total Pendapatan (dengan perbandingan periode sebelumnya)
-   Total Pesanan (dengan growth indicator)
-   Rata-rata Nilai Order
-   Order Selesai vs Pending

**2. Visualisasi Data:**

-   Grafik Pendapatan Harian (Line Chart menggunakan Chart.js)
-   Distribusi Status Pesanan (Progress Bars)
-   Status Pembayaran (Verified, Pending, Rejected)

**3. Analisis Produk:**

-   Top 5 Produk Terlaris (total penjualan & revenue)
-   Pendapatan per Kategori Produk (dengan percentage breakdown)

**4. Monitoring:**

-   Pesanan Terbaru (10 terakhir dengan status)
-   Peringatan Stok (produk habis & stok menipis)
-   Statistik Customer (khusus admin)

### Implementasi Backend

**Controller: `ReportController.php`**

```php
// Mengambil statistik penjualan dengan query Eloquent
private function getSalesStatistics($startDate, $endDate)
{
    $orders = Order::whereBetween('created_at', [$startDate, $endDate])
        ->where('status', '!=', 'rejected');

    return [
        'total_orders' => $orders->count(),
        'completed_orders' => $orders->where('status', 'completed')->count(),
        'total_revenue' => $orders->where('status', 'completed')->sum('total'),
        'average_order_value' => $orders->where('status', 'completed')->avg('total'),
    ];
}

// Top products dengan JOIN query
private function getTopProducts($startDate, $endDate, $limit = 10)
{
    return OrderItem::select('product_id', 'product_name',
            DB::raw('SUM(quantity) as total_sold'),
            DB::raw('SUM(subtotal) as total_revenue'))
        ->whereHas('order', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate])
                  ->where('status', 'completed');
        })
        ->groupBy('product_id', 'product_name')
        ->orderBy('total_sold', 'desc')
        ->limit($limit)
        ->get();
}
```

### Implementasi Frontend

**View: `resources/views/admin/reports/index.blade.php`**

**Responsive Statistics Cards:**

```blade
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Total Revenue Card dengan gradient & growth indicator -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
        <h3>Rp {{ number_format($salesStats['total_revenue']) }}</h3>
        @if($revenueGrowth >= 0)
            <span>+{{ number_format($revenueGrowth, 1) }}%</span>
        @endif
    </div>
</div>
```

**Interactive Chart dengan Chart.js:**

```javascript
new Chart(ctx, {
    type: "line",
    data: {
        labels: dailyRevenue.map((item) => item.formatted_date),
        datasets: [
            {
                label: "Pendapatan",
                data: dailyRevenue.map((item) => item.revenue),
                borderColor: "#72BF78",
                backgroundColor: "rgba(114, 191, 120, 0.1)",
                tension: 0.4,
                fill: true,
            },
        ],
    },
});
```

**Filter Periode Dinamis:**

```blade
<form action="{{ route('reports.index') }}" method="GET">
    <select name="period" onchange="toggleCustomDate()">
        <option value="daily">Hari Ini</option>
        <option value="weekly">Minggu Ini</option>
        <option value="monthly">Bulan Ini</option>
        <option value="custom">Custom</option>
    </select>
    <!-- Custom date range fields (toggle) -->
</form>
```

### Hak Akses

-   **Admin**: Full access ke semua laporan termasuk statistik customer
-   **Staff**: View-only access (tidak bisa export/download)
-   Kedua role dapat filter dan melihat semua visualisasi

### Route

```php
Route::prefix('reports')->middleware(['auth', 'role:admin,staff'])
     ->name('reports.')->group(function() {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::post('/sales', [ReportController::class, 'generateSales'])->name('sales');
    Route::post('/stock', [ReportController::class, 'generateStock'])->name('stock');
});
```

### Benefit untuk Bisnis

1. **Decision Making**: Data-driven decisions berdasarkan trend penjualan
2. **Inventory Management**: Early warning untuk stok menipis
3. **Performance Tracking**: Monitor KPI (revenue, order completion rate)
4. **Product Strategy**: Identifikasi produk terlaris untuk stock planning
5. **Time Analysis**: Pattern penjualan berdasarkan periode waktu

---

**Referensi:**

-   Laravel Documentation: https://laravel.com/docs
-   Tailwind CSS Documentation: https://tailwindcss.com/docs
-   Chart.js Documentation: https://www.chartjs.org/docs
-   PHP Official Documentation: https://www.php.net/docs.php
-   MDN Web Docs: https://developer.mozilla.org/
