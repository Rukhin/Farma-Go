# Manajemen Obat - Dokumentasi Fitur

## Ringkasan
Fitur Manajemen Obat telah ditambahkan ke sistem apotek untuk mengelola data obat secara komprehensif dengan fitur CRUD lengkap, filter, pencarian, dan export data.

## Fitur Utama

### 1. **Daftar Obat** (`medicines.index`)
- **Akses**: `/medicines`
- **Fitur**:
  - Menampilkan tabel lengkap semua obat
  - Pencarian berdasarkan nama atau kode obat
  - Filter berdasarkan kategori
  - Filter berdasarkan status stok (Normal, Rendah, Kosong)
  - Pagination (15 item per halaman)
  - Export ke CSV
  - Status stok visual (badge)
  - Aksi: Lihat, Edit, Hapus

### 2. **Tambah Obat Baru** (`medicines.create`)
- **Akses**: `/medicines/create`
- **Form Fields**:
  - Kode Obat (unik, required)
  - Nama Obat (required)
  - Kategori (required, select dari medicine_categories)
  - Unit/Satuan (required, contoh: Tablet, Botol, Kotak)
  - Harga Beli (Rp, required, numeric)
  - Harga Jual (Rp, required, numeric)
  - Stok Awal (required, integer)
  - Stok Minimum (required, integer)
  - Deskripsi (optional, textarea)

- **Validasi**:
  - Kode harus unik
  - Harga jual harus >= harga beli
  - Semua field wajib diisi sesuai requirement

### 3. **Edit Obat** (`medicines.edit`)
- **Akses**: `/medicines/{id}/edit`
- **Form Fields**: Sama seperti form tambah obat
- **Validasi**: Sama seperti tambah obat (dengan exception untuk unique code)

### 4. **Detail Obat** (`medicines.show`)
- **Akses**: `/medicines/{id}`
- **Informasi Ditampilkan**:
  - Data lengkap obat
  - Kategori
  - Harga beli & harga jual
  - Kalkulasi margin keuntungan
  - Status stok (Kosong/Rendah/Aman)
  - Nilai stok total (stok × harga beli)
  - Tanggal dibuat dan diperbarui
  - Tombol Edit & Hapus

### 5. **Hapus Obat** (`medicines.destroy`)
- **Akses**: Route DELETE ke `/medicines/{id}`
- **Validasi**:
  - Obat tidak dapat dihapus jika sudah terlibat dalam transaksi (purchase/sale)
  - Konfirmasi sebelum penghapusan

### 6. **Export CSV** (`medicines.export`)
- **Akses**: Tombol "📥 Export CSV" di halaman index
- **Format File**: `obat_YYYY-MM-DD_HH-mm-ss.csv`
- **Kolom Ekspor**:
  - Kode
  - Nama
  - Kategori
  - Unit
  - Harga Beli
  - Harga Jual
  - Stok
  - Min Stok
  - Deskripsi

## Routes yang Ditambahkan

```php
// Medicines Management
Route::resource('medicines', MedicineController::class);
Route::get('medicines/export/csv', [MedicineController::class, 'export'])->name('medicines.export');
Route::post('medicines/bulk-update-stock', [MedicineController::class, 'bulkUpdateStock'])->name('medicines.bulkUpdateStock');
```

## File-File yang Dibuat/Dimodifikasi

### Controllers
- `app/Http/Controllers/MedicineController.php` (BARU)

### Form Requests
- `app/Http/Requests/StoreMedicineRequest.php` (BARU)
- `app/Http/Requests/UpdateMedicineRequest.php` (BARU)

### Views (Blade Templates)
- `resources/views/medicines/index.blade.php` (BARU)
- `resources/views/medicines/create.blade.php` (BARU)
- `resources/views/medicines/edit.blade.php` (BARU)
- `resources/views/medicines/show.blade.php` (BARU)

### Modified Files
- `app/Models/Medicine.php` (ditambahkan relasi ke PurchaseItem & SaleItem)
- `routes/web.php` (ditambahkan routes medicines)
- `resources/views/dashboard.blade.php` (ditambahkan card manajemen obat)

## Model & Validasi

### Medicine Model
```php
class Medicine extends Model
{
    protected $fillable = [
        'code', 'name', 'medicine_category_id', 'unit',
        'price_purchase', 'price_sale', 'stock', 'min_stock', 'description'
    ];

    public function category() { /* ... */ }
    public function purchaseItems() { /* ... */ }
    public function saleItems() { /* ... */ }
}
```

### Validasi Rules

#### StoreMedicineRequest
- `code`: required, string, unique, max:50
- `name`: required, string, max:255
- `medicine_category_id`: required, exists:medicine_categories
- `unit`: required, string, max:50
- `price_purchase`: required, numeric, min:0
- `price_sale`: required, numeric, min:0
- `stock`: required, integer, min:0
- `min_stock`: required, integer, min:0
- `description`: nullable, string

#### UpdateMedicineRequest
- Sama seperti StoreMedicineRequest, dengan exception untuk unique code

## Integrasi dengan Dashboard

Dashboard telah diperbarui dengan:
- Card baru untuk "Manajemen Obat" dengan link ke `/medicines`
- Card tersegmentasi menjadi 3 kolom (Manajemen Obat, Pembelian, Penjualan/Laporan)

## UI/UX Features

### Daftar Obat (Index)
- Responsive table design
- Pagination
- Filter & search box
- Status badges dengan color coding:
  - 🟢 Aman (stok >= min_stock)
  - 🟡 Rendah (stok < min_stock)
  - 🔴 Kosong (stok = 0)
- Action icons untuk lihat, edit, hapus

### Form Pages
- Responsive grid layout
- Clear field labeling dengan indikator field wajib (*)
- Error message display
- Inline form validation
- Action buttons (Simpan/Batal)

### Detail Page
- Comprehensive information display
- Visual status indicators
- Margin profit calculation
- Stock value calculation
- Timestamp information
- Edit/Delete buttons

## Penggunaan

### Akses Manajemen Obat
1. Login ke dashboard
2. Klik card "💊 Manajemen Obat" atau akses langsung `/medicines`

### Tambah Obat Baru
1. Klik tombol "➕ Tambah Obat"
2. Isi form dengan data lengkap
3. Klik "💾 Simpan Obat"

### Edit Obat
1. Dari halaman daftar, klik icon ✏️ (edit)
2. Update data yang diperlukan
3. Klik "💾 Update Obat"

### Lihat Detail Obat
1. Dari halaman daftar, klik icon 👁️ (lihat)
2. Review semua informasi obat termasuk kalkulasi margin

### Hapus Obat
1. Dari halaman daftar atau detail, klik icon 🗑️
2. Konfirmasi penghapusan (jika obat belum ada transaksi)

### Cari & Filter
1. Di halaman daftar, gunakan field "Cari Obat"
2. Gunakan dropdown "Kategori" untuk filter kategori
3. Gunakan dropdown "Status Stok" untuk filter status
4. Klik "🔍 Filter" untuk apply filter

### Export Data
1. Klik tombol "📥 Export CSV"
2. File CSV akan didownload ke komputer

## Validasi & Keamanan

- **Unique Code**: Kode obat harus unik di database
- **Price Validation**: Harga jual harus lebih besar atau sama dengan harga beli
- **Stock Validation**: Obat tidak dapat dihapus jika sudah ada transaksi
- **Form Request Validation**: Semua input divalidasi dengan StoreMedicineRequest & UpdateMedicineRequest
- **Custom Error Messages**: Pesan error dalam bahasa Indonesia

## Future Enhancements

Fitur-fitur yang dapat ditambahkan di masa depan:
1. **Bulk Import**: Import obat dari file CSV/Excel
2. **Barcode**: Generate & scan barcode untuk obat
3. **Stock Adjustment**: Pencatatan penyesuaian stok manual
4. **Expiry Date**: Pengelolaan tanggal kadaluarsa obat
5. **Multiple Prices**: Support untuk harga per supplier berbeda
6. **Batch Management**: Pengelolaan batch/lot obat
7. **Stock History**: Audit trail untuk perubahan stok
8. **Photo/Image**: Support untuk foto obat
9. **API Endpoint**: REST API untuk mobile app
10. **Advanced Reports**: Laporan analisis stok & penjualan per obat

## Kesimpulan

Fitur Manajemen Obat memberikan kontrol penuh atas data master obat dengan interface yang user-friendly, validasi yang ketat, dan integrasi sempurna dengan sistem pembelian dan penjualan yang sudah ada.
