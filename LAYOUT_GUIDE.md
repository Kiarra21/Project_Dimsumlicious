# 📚 Struktur Layout Dimsumlicious

## 🎨 Overview

Project Dimsumlicious sekarang memiliki 2 layout utama yang terpisah untuk Admin dan User/Guest dengan desain yang konsisten dan responsif.

---

## 🔑 Layout Structure

### 1. **Admin Layout** (`layouts/admin.blade.php`)

Layout khusus untuk halaman admin dengan **Sidebar + Navbar**

#### Komponen:

-   ✅ **Sidebar** (`components/admin/sidebar.blade.php`)

    -   Logo & Brand
    -   Navigation Menu (sesuai role)
    -   User Info & Logout
    -   Responsive (collapsible di mobile)

-   ✅ **Navbar** (`components/admin/navbar.blade.php`)
    -   Mobile menu toggle
    -   Page title & subtitle
    -   Search bar (desktop)
    -   Notifications
    -   Quick actions

#### Features:

-   **Role-based Menu**: Admin vs Staff
-   **Mobile Responsive**: Sidebar slide-in animation
-   **Modern Design**: Clean & professional
-   **Easy Navigation**: Icon + text menu items

---

### 2. **User/Guest Layout** (`layouts/user.blade.php`)

Layout untuk pengunjung dengan **Navbar + Footer**

#### Komponen:

-   ✅ **Navbar** (`components/user/navbar.blade.php`)

    -   Logo & Brand
    -   Navigation links (Beranda, Produk, Promo, Tentang, Kontak)
    -   Shopping cart icon
    -   Login button / User menu
    -   Mobile menu (hamburger)

-   ✅ **Footer** (`components/user/footer.blade.php`)
    -   Brand info & social media
    -   Quick links
    -   Kategori produk
    -   Contact information
    -   WhatsApp float button

#### Features:

-   **Guest & Auth Support**: Tampilan berbeda untuk user login/logout
-   **Mobile Friendly**: Hamburger menu di mobile
-   **Interactive**: Smooth transitions & animations
-   **Contact Ready**: WhatsApp float button

---

## 📁 File Structure

```
resources/views/
├── layouts/
│   ├── admin.blade.php          # Admin layout (Sidebar + Navbar)
│   ├── user.blade.php           # User layout (Navbar + Footer)
│   └── app.blade.php            # Old layout (deprecated)
│
├── components/
│   ├── admin/
│   │   ├── sidebar.blade.php    # Admin sidebar menu
│   │   └── navbar.blade.php     # Admin top navbar
│   │
│   └── user/
│       ├── navbar.blade.php     # User top navbar
│       └── footer.blade.php     # User footer
│
└── pages/
    ├── dashboard.blade.php      # Admin dashboard (uses admin layout)
    ├── home.blade.php           # User homepage (uses user layout)
    └── ...
```

---

## 🎯 Usage Guide

### Untuk Halaman Admin:

```blade
@extends('layouts.admin')

@section('title', 'Judul Halaman')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola bisnis Anda')

@section('content')
    <!-- Konten halaman admin -->
@endsection
```

### Untuk Halaman User/Guest:

```blade
@extends('layouts.user')

@section('title', 'Judul Halaman')

@section('content')
    <!-- Konten halaman user -->
@endsection
```

---

## 🎨 Design System

### Color Palette:

```css
--primary: #72BF78    /* Hijau utama */
--secondary: #A0D683  /* Hijau muda */
--accent: #D3EE98     /* Hijau pucat */
--highlight: #FEFF9F  /* Kuning highlight */
```

### Components:

-   ✅ Card hover effects
-   ✅ Button animations (ripple effect)
-   ✅ Smooth transitions
-   ✅ Responsive grids
-   ✅ Icon integration

---

## 📱 Responsive Design

### Breakpoints:

-   **Mobile**: < 768px (sidebar slide-in, hamburger menu)
-   **Tablet**: 768px - 1024px
-   **Desktop**: > 1024px

### Features:

-   ✅ Mobile-first approach
-   ✅ Touch-friendly buttons
-   ✅ Collapsible menus
-   ✅ Adaptive layouts

---

## 🚀 Menu Items Sesuai Fitur Project

### **Admin Menu** (Full Access):

1. 📊 Dashboard
2. 📦 Manajemen Produk
3. 🏷️ Kategori Produk
4. 👥 Manajemen Staff
5. 📈 Laporan Penjualan
6. ⭐ Promosi
7. 🏢 Company Profile
8. 👤 Profile
9. ⚙️ Pengaturan

### **Staff Menu** (Limited Access):

1. 📊 Dashboard
2. 📦 Manajemen Produk (Limited)
3. 🏷️ Kategori Produk
4. 📈 Laporan (View Only)
5. ⭐ Promosi
6. 👤 Profile
7. ⚙️ Pengaturan

### **User/Guest Menu**:

1. 🏠 Beranda
2. 🍽️ Produk
3. 🎉 Promo
4. ℹ️ Tentang Kami
5. 📞 Kontak

---

## ✨ Key Features

### Admin Layout:

-   ✅ Sidebar navigation dengan role-based menu
-   ✅ Top navbar dengan search & notifications
-   ✅ Mobile responsive dengan overlay
-   ✅ User info & quick logout
-   ✅ Breadcrumb support

### User Layout:

-   ✅ Clean navigation bar
-   ✅ Shopping cart preview
-   ✅ Comprehensive footer
-   ✅ WhatsApp float button
-   ✅ Social media links
-   ✅ Mobile hamburger menu

---

## 🔧 Customization

### Menambah Menu Admin:

Edit file: `resources/views/components/admin/sidebar.blade.php`

```blade
<a href="{{ route('your-route') }}"
   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300">
    <svg class="w-5 h-5 mr-3"><!-- Icon SVG --></svg>
    <span class="font-medium">Menu Name</span>
</a>
```

### Menambah Menu User:

Edit file: `resources/views/components/user/navbar.blade.php`

```blade
<a href="#section" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
    Menu Name
</a>
```

---

## 📌 Next Steps

1. ✅ Layout struktur sudah dibuat
2. ⏳ Implementasi routing
3. ⏳ Implementasi authentication
4. ⏳ Role management (Admin/Staff)
5. ⏳ Database integration
6. ⏳ CRUD functionality
7. ⏳ Shopping cart & order system

---

## 🎉 Benefits

✨ **Organized**: Struktur file yang rapi dan terorganisir
✨ **Reusable**: Komponen dapat digunakan ulang
✨ **Maintainable**: Mudah di-maintain dan update
✨ **Scalable**: Mudah ditambah fitur baru
✨ **Professional**: Tampilan modern dan profesional
✨ **Responsive**: Bekerja di semua device

---

**Created with ❤️ for Dimsumlicious Project**
