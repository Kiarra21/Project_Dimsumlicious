# 📊 Dashboard Dinamis - Dimsumlicious

## 🎯 Deskripsi

Dashboard dinamis yang menampilkan statistik real-time dari database untuk monitoring bisnis Dimsumlicious. Dashboard ini mengambil data langsung dari tabel `products`, `orders`, `order_items`, dan `users` untuk memberikan insight akurat tentang performa bisnis.

---

## 🔑 Fitur Utama

### 1. **Kartu Statistik Dinamis (KPI Cards)**

Setiap kartu menampilkan data real-time dengan indikator pertumbuhan:

#### 📦 Total Produk

```php
// Data dari tabel: products
- Total produk aktif dalam database
- Growth percentage vs bulan lalu
- Warna indikator:
  ✅ Hijau: Pertumbuhan positif
  🔴 Merah: Penurunan
  ⚪ Abu-abu: Tidak ada perubahan
```

**Formula:**

```php
$totalProducts = Product::count();
$lastMonthProducts = Product::where('created_at', '<=', Carbon::now()->subMonth())->count();
$productGrowth = (($totalProducts - $lastMonthProducts) / $lastMonthProducts) * 100;
```

#### ⚠️ Stok Rendah

```php
// Data dari tabel: products
- Jumlah produk dengan stock ≤ 10
- Perubahan jumlah vs kemarin
- Warna indikator:
  🔴 Merah: Bertambah (buruk)
  ✅ Hijau: Berkurang (baik)
  ⚪ Abu-abu: Tidak berubah
```

**Formula:**

```php
$lowStock = Product::where('stock', '<=', 10)->count();
$yesterdayLowStock = Product::where('stock', '<=', 10)
    ->where('updated_at', '<', Carbon::today())
    ->count();
$lowStockChange = $lowStock - $yesterdayLowStock;
```

#### 🛒 Total Penjualan

```php
// Data dari tabel: orders
- Jumlah order dengan status "completed" bulan ini
- Growth percentage vs bulan lalu
- Warna indikator:
  ✅ Hijau: Pertumbuhan positif
  🔴 Merah: Penurunan
  ⚪ Abu-abu: Tidak ada perubahan
```

**Formula:**

```php
$totalSales = Order::where('status', 'completed')
    ->whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->count();

$lastMonthSales = Order::where('status', 'completed')
    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
    ->whereYear('created_at', Carbon::now()->subMonth()->year)
    ->count();

$salesGrowth = (($totalSales - $lastMonthSales) / $lastMonthSales) * 100;
```

#### 💰 Pendapatan

```php
// Data dari tabel: orders
- Total revenue dari order completed bulan ini
- Growth percentage vs bulan lalu
- Format: Rp xxx.xxx.xxx
- Warna indikator:
  ✅ Hijau: Pertumbuhan positif
  🔴 Merah: Penurunan
  ⚪ Abu-abu: Tidak ada perubahan
```

**Formula:**

```php
$revenue = Order::where('status', 'completed')
    ->whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->sum('total_amount');

$lastMonthRevenue = Order::where('status', 'completed')
    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
    ->whereYear('created_at', Carbon::now()->subMonth()->year)
    ->sum('total_amount');

$revenueGrowth = (($revenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
```

---

### 2. **Grafik Penjualan (6 Bulan Terakhir)**

Menampilkan visualisasi bar chart dengan 2 dataset:

#### Dataset 1: Penjualan Dimsum

```php
// Jumlah order completed per bulan × 10 (untuk skala visualisasi)
$salesCount = Order::where('status', 'completed')
    ->whereYear('created_at', $month->year)
    ->whereMonth('created_at', $month->month)
    ->count();

$salesData[] = $salesCount * 10;
```

#### Dataset 2: Produk Terjual

```php
// Total quantity dari order items bulan tersebut
$itemsCount = OrderItem::whereHas('order', function($query) use ($month) {
        $query->where('status', 'completed')
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month);
    })
    ->sum('quantity');
```

**Warna:**

-   🟢 Primary (#72BF78): Penjualan Dimsum
-   🟡 Secondary (#A0D683): Produk Terjual

---

### 3. **Aktivitas Terbaru (Real-time)**

Menampilkan maksimal 4 aktivitas terakhir secara dinamis:

#### 🛒 Produk Terbaru

```php
$latestProduct = Product::latest()->first();
// Output: "Produk '[Nama]' ditambahkan"
// Time: diffForHumans() - "2 menit yang lalu"
```

#### 📦 Pesanan Terbaru

```php
$latestOrder = Order::latest()->first();
// Output: "Pesanan baru #[ID] diterima"
// Time: diffForHumans()
// User: nama customer
```

#### ⚠️ Stok Rendah

```php
$lowStockProduct = Product::where('stock', '<=', 10)
    ->where('stock', '>', 0)
    ->orderBy('stock', 'asc')
    ->first();
// Output: "Stok '[Nama]' rendah ([X] unit)"
```

#### 🚨 Habis Stok

```php
$outOfStockCount = Product::where('stock', 0)->count();
// Output: "[X] produk habis stok"
```

#### 📈 Tren Penjualan

```php
// Bandingkan 7 hari terakhir vs 7 hari sebelumnya
$currentWeekSales = Order::where('status', 'completed')
    ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
    ->count();

$previousWeekSales = Order::where('status', 'completed')
    ->whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])
    ->count();

$percentage = (($currentWeekSales - $previousWeekSales) / $previousWeekSales) * 100;
// Output: "Penjualan meningkat [X]% minggu ini"
```

---

## 🔐 Perbedaan Dashboard Berdasarkan Role

### 👑 Admin Dashboard

**Route:** `/dashboard`
**View:** `resources/views/dashboard.blade.php`

✅ **Fitur:**

-   4 KPI Cards lengkap
-   Grafik penjualan 6 bulan
-   Aktivitas terbaru (real-time)
-   Aksi cepat (3 buttons)

### 👨‍💼 Staff Dashboard

**Route:** `/dashboard`
**View:** `resources/views/dashboard-staff.blade.php`

✅ **Fitur:**

-   3 KPI Cards (tanpa revenue detail)
-   Aktivitas terbaru
-   Catatan penting untuk staff
-   Menu akses staff (4 buttons)

---

## 🛠️ Implementasi Teknis

### Controller

**File:** `app/Http/Controllers/DashboardController.php`

**Methods:**

```php
public function index()
- Route: GET /dashboard
- Logic: Deteksi role user (admin/staff)
- Return: View sesuai role dengan data

private function getStatistics()
- Mengambil statistik dari database
- Hitung growth percentage untuk setiap metric
- Return array dengan 8 key:
  * total_products
  * product_growth
  * low_stock
  * low_stock_change
  * total_sales
  * sales_growth
  * revenue
  * revenue_growth

private function getChartData()
- Generate data 6 bulan terakhir
- Query orders & order_items per bulan
- Return array dengan labels & datasets

private function getRecentActivities()
- Query aktivitas terbaru dari berbagai tabel
- Maximum 4 aktivitas
- Return array dengan icon, action, time, user
```

### Models yang Digunakan

```php
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
```

### View Components

#### Admin Dashboard Cards

```blade
<!-- Total Produk -->
<div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-primary">
    @if($stats['product_growth'] > 0)
        <span class="text-green-600">+{{ number_format($stats['product_growth'], 1) }}%</span>
    @elseif($stats['product_growth'] < 0)
        <span class="text-red-600">{{ number_format($stats['product_growth'], 1) }}%</span>
    @else
        <span class="text-gray-600">Tidak ada perubahan</span>
    @endif
</div>
```

#### Staff Dashboard Cards

```blade
<!-- Sama seperti admin, tapi hanya 3 cards (tanpa revenue) -->
```

---

## 📊 Contoh Output Data

### Statistik Array

```php
[
    'total_products' => 45,        // Total produk di database
    'product_growth' => 12.5,      // +12.5% dari bulan lalu
    'low_stock' => 8,              // 8 produk stock ≤ 10
    'low_stock_change' => 3,       // +3 dari kemarin
    'total_sales' => 125,          // 125 order completed bulan ini
    'sales_growth' => 8.7,         // +8.7% dari bulan lalu
    'revenue' => 15670000,         // Rp 15.670.000
    'revenue_growth' => 15.3       // +15.3% dari bulan lalu
]
```

### Chart Data Array

```php
[
    'labels' => ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
    'datasets' => [
        [
            'label' => 'Penjualan Dimsum',
            'data' => [650, 780, 900, 850, 950, 1100],
            'backgroundColor' => '#72BF78'
        ],
        [
            'label' => 'Produk Terjual',
            'data' => [450, 600, 750, 800, 880, 950],
            'backgroundColor' => '#A0D683'
        ]
    ]
]
```

### Recent Activities Array

```php
[
    [
        'icon' => 'shopping-cart',
        'action' => 'Produk "Siomay Ayam Special" ditambahkan',
        'time' => '2 menit yang lalu',
        'user' => 'Admin'
    ],
    [
        'icon' => 'chart-bar',
        'action' => 'Pesanan baru #1234 diterima',
        'time' => '5 menit yang lalu',
        'user' => 'John Doe'
    ],
    [
        'icon' => 'exclamation-triangle',
        'action' => 'Stok "Hakau Udang" rendah (5 unit)',
        'time' => 'Sekarang',
        'user' => 'System'
    ],
    [
        'icon' => 'trending-up',
        'action' => 'Penjualan meningkat 15% minggu ini',
        'time' => '7 hari terakhir',
        'user' => 'System'
    ]
]
```

---

## 🎨 Styling & UI/UX

### Warna Indikator

```css
✅ Hijau (Positif): text-green-600
🔴 Merah (Negatif): text-red-600
⚪ Abu-abu (Netral): text-gray-600
🟡 Warning: text-yellow-600
```

### Kartu Styling

```css
- Rounded corners: rounded-2xl
- Shadow: shadow-lg
- Hover effect: card-hover (custom)
- Border kiri: border-l-4 dengan warna berbeda per card
```

### Responsiveness

```css
- Mobile: 1 column
- Tablet (sm): 2 columns
- Desktop (lg): 4 columns
- Grid system: grid-cols-1 sm:grid-cols-2 lg:grid-cols-4
```

---

## 🔄 Update Log

### Version 2.0 (November 25, 2025)

✅ **Perubahan Major:**

-   Mengganti data mock dengan data real dari database
-   Implementasi perhitungan growth percentage dinamis
-   Tambah comparison logic untuk KPI cards
-   Update aktivitas terbaru dengan data real-time
-   Optimasi query database untuk performa

✅ **Improvement:**

-   Growth indicator dengan 3 kondisi (positif/negatif/netral)
-   Color coding otomatis berdasarkan nilai
-   Aktivitas terbaru max 4 items (prioritas tinggi)
-   Chart data dari 6 bulan real transaction

### Version 1.0 (Sebelumnya)

-   Dashboard dengan data mock/statis
-   KPI cards tanpa comparison
-   Aktivitas statis

---

## 🚀 Cara Penggunaan

### Akses Dashboard

1. Login sebagai **Admin** atau **Staff**
2. Otomatis redirect ke dashboard sesuai role
3. Dashboard akan load data real-time dari database

### Membaca Statistik

1. **Hijau ↑**: Pertumbuhan positif (bagus)
2. **Merah ↓**: Penurunan (perlu perhatian)
3. **Abu-abu ↔**: Stabil (tidak berubah)

### Monitoring Aktivitas

-   Cek section "Aktivitas Terbaru" untuk update real-time
-   Icon ⚠️ menunjukkan alert yang perlu perhatian
-   Icon 📈 menunjukkan tren positif

---

## 📝 Catatan Penting

### Performance

-   Query dioptimasi dengan indexing pada `created_at` dan `status`
-   Growth calculation dilakukan di backend untuk akurasi
-   Chart data limited ke 6 bulan untuk load time optimal

### Data Accuracy

-   Semua data real-time dari database
-   Growth percentage dengan 1 decimal precision
-   Revenue dalam format Rupiah Indonesia
-   Timestamp menggunakan Carbon untuk human-readable format

### Security

-   Dashboard hanya accessible untuk authenticated users
-   Role-based view rendering di backend
-   Tidak ada sensitive data exposed di frontend

---

## 🐛 Troubleshooting

### Dashboard Kosong / Data 0

**Masalah:** Semua statistik menampilkan 0
**Solusi:**

1. Pastikan ada data di tabel `products` dan `orders`
2. Check status order sudah ada yang "completed"
3. Verifikasi tanggal `created_at` tidak di masa depan

### Growth Percentage Error

**Masalah:** Division by zero error
**Solusi:**

-   Handled dengan conditional:

```php
$growth = $lastMonthValue > 0
    ? (($currentValue - $lastMonthValue) / $lastMonthValue) * 100
    : 0;
```

### Aktivitas Tidak Muncul

**Masalah:** Section "Aktivitas Terbaru" kosong
**Solusi:**

1. Check ada produk/order di database
2. Verifikasi relationship di Model
3. Fallback default message sudah di-handle

---

## 📞 Support

Untuk pertanyaan atau issue terkait dashboard dinamis:

-   Repository: Project_Dimsumlicious
-   Developer: Kiarra21
-   Last Update: November 25, 2025
