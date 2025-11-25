# 📊 FITUR LAPORAN PENJUALAN - DIMSUMLICIOUS

## Deskripsi

Fitur Laporan Penjualan adalah dashboard analitik komprehensif yang memberikan insight mendalam tentang performa bisnis Dimsumlicious. Dashboard ini dirancang untuk Admin dan Staff dalam memantau penjualan, revenue, produk terlaris, dan status operasional.

---

## 🎯 Fitur Utama

### 1. **Filter Periode Dinamis**

-   **Hari Ini**: Laporan real-time untuk hari berjalan
-   **Minggu Ini**: Performa seminggu terakhir
-   **Bulan Ini**: Overview bulanan
-   **Tahun Ini**: Analisis tahunan
-   **Custom Range**: Pilih rentang tanggal sesuai kebutuhan

### 2. **Statistik Utama (KPI Cards)**

-   ✅ **Total Pendapatan**: Revenue keseluruhan dengan growth indicator
-   📦 **Total Pesanan**: Jumlah order dengan perbandingan periode sebelumnya
-   💰 **Rata-rata Nilai Order**: Average order value untuk analisis pricing
-   ✓ **Order Selesai**: Completion rate dengan breakdown pending & processing

### 3. **Visualisasi Data**

-   📈 **Grafik Pendapatan Harian**: Line chart interaktif menggunakan Chart.js
-   📊 **Distribusi Status Pesanan**: Visual breakdown completed/processing/pending
-   💳 **Status Pembayaran**: Monitoring verified/pending/rejected payments

### 4. **Analisis Produk**

-   🏆 **Top 5 Produk Terlaris**: Ranking berdasarkan total penjualan & revenue
-   📁 **Pendapatan per Kategori**: Breakdown revenue dengan percentage
-   🔥 **Product Performance**: Insight untuk inventory planning

### 5. **Monitoring Real-time**

-   🆕 **10 Pesanan Terbaru**: Quick view dengan status tracking
-   ⚠️ **Peringatan Stok**: Alert untuk produk habis & menipis
-   👥 **Statistik Customer**: Total customer & new registrations (Admin only)

---

## 🔐 Hak Akses

### Admin (Full Access)

-   ✅ Akses ke semua fitur laporan
-   ✅ Statistik customer
-   ✅ Export laporan (future feature)
-   ✅ Download report PDF/Excel (future feature)

### Staff (View Only)

-   ✅ Lihat semua visualisasi
-   ✅ Filter berdasarkan periode
-   ✅ Monitor produk & pesanan
-   ❌ Export/download report (restricted)

---

## 🛠️ Cara Menggunakan

### Akses Halaman Laporan

1. Login sebagai Admin atau Staff
2. Klik menu **"Laporan"** di sidebar
3. Dashboard laporan akan terbuka dengan data bulan ini secara default

### Filter Berdasarkan Periode

**Opsi 1: Preset Period**

```
1. Pilih dropdown "Periode"
2. Pilih: Hari Ini / Minggu Ini / Bulan Ini / Tahun Ini
3. Klik tombol "Tampilkan"
4. Dashboard akan update dengan data periode yang dipilih
```

**Opsi 2: Custom Date Range**

```
1. Pilih "Custom" di dropdown Periode
2. Field "Dari Tanggal" dan "Sampai Tanggal" akan muncul
3. Pilih rentang tanggal yang diinginkan
4. Klik "Tampilkan" untuk generate laporan
```

### Membaca Grafik Pendapatan

-   **Sumbu X**: Tanggal (format: DD MMM)
-   **Sumbu Y**: Nilai pendapatan dalam Rupiah
-   **Hover**: Hover mouse pada titik untuk detail nilai
-   **Warna Hijau**: Mengikuti brand color Dimsumlicious (#72BF78)

### Interpretasi Growth Indicator

-   **↑ +X%** (Hijau): Pertumbuhan positif vs periode sebelumnya
-   **↓ -X%** (Merah): Penurunan vs periode sebelumnya
-   **Periode Sebelumnya**: Periode dengan durasi yang sama sebelum range yang dipilih

Contoh:

```
Jika pilih "Minggu Ini" (7 hari)
→ Dibandingkan dengan 7 hari sebelumnya
```

### Menggunakan Data Produk Terlaris

**Top Products Ranking:**

-   🥇 Peringkat 1: Badge warna emas
-   🥈 Peringkat 2: Badge warna perak
-   🥉 Peringkat 3: Badge warna perunggu
-   Lainnya: Badge abu-abu

**Insight yang Bisa Didapat:**

1. Produk mana yang harus selalu ready stock
2. Produk mana yang perlu promosi lebih
3. Produk mana yang bisa dikurangi produksi

### Monitor Stock Alerts

**Warna Kode:**

-   🔴 **Merah (Stok Habis)**: Segera restock!
-   🟡 **Kuning (Stok ≤ 10)**: Warning, akan habis

**Action yang Perlu Dilakukan:**

1. Cek produk dengan alert merah → Prioritas tertinggi untuk restock
2. Cek produk kuning → Planning restock dalam waktu dekat
3. Update stock melalui menu Produk

---

## 📱 Responsive Design

Dashboard fully responsive dan dapat diakses dari:

-   💻 **Desktop**: Layout 4 kolom untuk KPI cards
-   📱 **Tablet**: Layout 2 kolom dengan scroll
-   📱 **Mobile**: Layout 1 kolom, touch-friendly

---

## 🎨 Teknologi yang Digunakan

### Backend

-   **Laravel 11**: Controller logic & database queries
-   **Eloquent ORM**: Query builder dengan relationships
-   **Carbon**: Date manipulation & formatting
-   **MySQL**: Aggregation queries (SUM, COUNT, AVG, GROUP BY)

### Frontend

-   **Blade Templates**: Server-side rendering
-   **Tailwind CSS**: Responsive utility classes
-   **Chart.js**: Interactive data visualization
-   **Vanilla JavaScript**: Dynamic interactions

### Database Queries

```php
// Contoh: Top Products Query
OrderItem::select('product_name', DB::raw('SUM(quantity) as total_sold'))
    ->whereHas('order', function($query) {
        $query->where('status', 'completed')
              ->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->groupBy('product_name')
    ->orderBy('total_sold', 'desc')
    ->limit(5)
    ->get();
```

---

## 📊 Contoh Use Case

### Skenario 1: Morning Review (Admin)

```
Waktu: Jam 9 pagi
Action:
1. Buka dashboard laporan
2. Pilih "Hari Ini"
3. Lihat berapa order pending payment
4. Cek pembayaran pending di tab Pembayaran
5. Verifikasi bukti transfer yang masuk
```

### Skenario 2: Weekly Performance Review

```
Waktu: Setiap Senin pagi
Action:
1. Pilih "Minggu Ini"
2. Compare growth dengan minggu sebelumnya
3. Identifikasi top 3 produk terlaris
4. Pastikan stock produk tersebut cukup
5. Planning promosi untuk produk dengan penjualan rendah
```

### Skenario 3: Monthly Business Report

```
Waktu: Akhir bulan
Action:
1. Pilih "Bulan Ini"
2. Catat total revenue
3. Analisis produk terlaris per kategori
4. Calculate profit margin
5. Planning strategi untuk bulan depan
```

### Skenario 4: Custom Campaign Analysis

```
Waktu: Setelah periode promosi selesai
Action:
1. Pilih "Custom" period
2. Set tanggal mulai = tanggal promo mulai
3. Set tanggal akhir = tanggal promo berakhir
4. Analisis peningkatan penjualan selama promo
5. Hitung ROI campaign
```

---

## 🚀 Future Enhancements

### Planned Features:

-   [ ] **Export to PDF**: Download laporan dalam format PDF
-   [ ] **Export to Excel**: Download data untuk analisis lanjutan
-   [ ] **Email Report**: Scheduled report dikirim via email
-   [ ] **Comparison View**: Side-by-side comparison 2 periode
-   [ ] **Profit Margin Calculator**: Revenue vs COGS analysis
-   [ ] **Customer Segmentation**: RFM analysis
-   [ ] **Predictive Analytics**: Forecast penjualan bulan depan
-   [ ] **Real-time Notification**: Alert saat order baru masuk

---

## 🐛 Troubleshooting

### Grafik tidak muncul?

```
Solusi:
1. Pastikan Chart.js ter-load (cek console browser)
2. Refresh halaman dengan Ctrl+F5
3. Clear browser cache
```

### Data tidak update?

```
Solusi:
1. Pastikan sudah klik tombol "Tampilkan"
2. Cek koneksi internet
3. Pastikan ada order dalam periode yang dipilih
```

### Growth indicator tidak muncul?

```
Alasan:
- Tidak ada data di periode sebelumnya untuk perbandingan
- Ini normal untuk data pertama kali
```

### Stock alert tidak akurat?

```
Solusi:
1. Update stock produk di menu Produk
2. Refresh dashboard laporan
3. Alert otomatis update berdasarkan stock terkini
```

---

## 📞 Support

Jika ada pertanyaan atau issue terkait fitur laporan:

1. Cek dokumentasi ini terlebih dahulu
2. Hubungi Admin untuk troubleshooting
3. Laporkan bug melalui sistem ticketing internal

---

## 📝 Changelog

### Version 1.0.0 (2025-11-24)

-   ✅ Initial release
-   ✅ Dashboard dengan 4 KPI cards
-   ✅ Grafik pendapatan harian (Chart.js)
-   ✅ Top 5 produk terlaris
-   ✅ Revenue by category
-   ✅ Stock alerts
-   ✅ Recent orders list
-   ✅ Filter periode (daily/weekly/monthly/yearly/custom)
-   ✅ Growth comparison dengan periode sebelumnya
-   ✅ Responsive design untuk semua devices
-   ✅ Role-based access (Admin & Staff)

---

**Developed with ❤️ by Dimsumlicious Team**
