# 💊 Panduan Cepat Manajemen Obat

## 🚀 Akses Cepat

### Cara 1: Via Dashboard
1. Login ke aplikasi
2. Di dashboard, klik card **"💊 Manajemen Obat"**
3. Atau klik link **"Obat"** di navigation bar

### Cara 2: URL Langsung
```
http://localhost:8000/medicines
```

---

## 📋 Menu Utama

| Menu | URL | Fungsi |
|------|-----|--------|
| Daftar Obat | `/medicines` | Melihat semua obat, search, filter |
| Tambah Obat | `/medicines/create` | Form untuk menambah obat baru |
| Edit Obat | `/medicines/{id}/edit` | Form untuk mengedit obat |
| Detail Obat | `/medicines/{id}` | Lihat detail lengkap obat |

---

## ✨ Operasi Dasar

### 1️⃣ TAMBAH OBAT BARU

**Langkah:**
1. Klik tombol **"➕ Tambah Obat"** di halaman Daftar Obat
2. Atau akses langsung: `/medicines/create`
3. Isi form dengan data lengkap:

**Form Fields:**
```
Kode Obat *              → MED001, OBT002, dll (UNIK)
Nama Obat *              → Paracetamol 500mg
Kategori *               → Pilih dari dropdown
Unit/Satuan *            → Tablet, Botol, Kotak, dll
Harga Beli (Rp) *        → Masukkan nominal harga
Harga Jual (Rp) *        → Harus lebih besar dari harga beli
Stok Awal *              → Jumlah stok awal
Stok Minimum *           → Alert jika stok di bawah ini
Deskripsi                → Opsional (catatan tambahan)
```

4. Klik **"💾 Simpan Obat"**

**Validasi:**
- ✅ Kode harus unik (tidak boleh sama)
- ✅ Semua field (*) harus diisi
- ✅ Harga jual ≥ harga beli
- ✅ Stok harus angka positif atau 0

---

### 2️⃣ LIHAT DAFTAR OBAT

**Akses:**
- Klik link **"Obat"** di navigation bar
- Atau buka `/medicines`

**Fitur di halaman Daftar:**

#### 📊 Informasi per Baris
```
Kode      → Kode unik obat
Nama      → Nama obat
Kategori  → Kategori obat
Unit      → Satuan obat
Harga Beli   → Harga beli dari supplier
Harga Jual   → Harga jual ke pelanggan
Stok      → Jumlah stok saat ini
Min Stok  → Target stok minimum
Status    → 🟢 Aman / 🟡 Rendah / 🔴 Kosong
Aksi      → 👁️ Lihat | ✏️ Edit | 🗑️ Hapus
```

#### 🔍 Cari Obat
```
1. Isi field "Cari Obat"
2. Ketik nama atau kode obat
3. Klik "🔍 Filter" atau Enter
```

#### 📁 Filter Kategori
```
1. Klik dropdown "Kategori"
2. Pilih kategori yang diinginkan
3. Klik "🔍 Filter"
```

#### 📊 Filter Status Stok
```
1. Klik dropdown "Status Stok"
2. Pilih:
   - "Stok Rendah" = Stok < minimum
   - "Stok Kosong" = Stok = 0
3. Klik "🔍 Filter"
```

#### 📥 Export ke CSV
```
1. Klik tombol "📥 Export CSV"
2. File akan didownload otomatis
3. Buka dengan Excel/Spreadsheet
```

#### Reset Filter
```
Klik tombol "Reset" untuk menghapus semua filter
```

---

### 3️⃣ LIHAT DETAIL OBAT

**Akses:**
1. Di halaman Daftar Obat
2. Klik icon **👁️** (lihat) di kolom Aksi
3. Atau akses langsung: `/medicines/{id}`

**Informasi yang Ditampilkan:**
```
📌 Header
- Nama Obat (besar)
- Kode Obat (mono font)

📋 Detail Lengkap
- Kategori
- Unit/Satuan
- Harga Beli
- Harga Jual
- Margin Keuntungan (otomatis dihitung)
- Stok Minimum

📦 Status Stok
- Stok Saat Ini (angka besar)
- Status Badge (Aman/Rendah/Kosong)
- Nilai Total Stok (stok × harga beli)

📝 Informasi Tambahan
- Deskripsi
- Tanggal dibuat
- Tanggal diperbarui

⚙️ Aksi
- Tombol Edit
- Tombol Hapus
```

**Rumus Margin:**
```
Margin % = ((Harga Jual - Harga Beli) / Harga Beli) × 100%
Contoh: Harga beli 1000, Harga jual 1500
Margin = ((1500 - 1000) / 1000) × 100 = 50%
```

---

### 4️⃣ EDIT OBAT

**Akses:**
1. Di halaman Daftar Obat, klik **✏️** di kolom Aksi
2. Atau di halaman Detail, klik tombol **"✏️ Edit"**
3. Atau akses langsung: `/medicines/{id}/edit`

**Langkah:**
1. Form akan terisi dengan data obat yang lama
2. Ubah data yang ingin diperbarui
3. Jangan lupa bahwa **kode obat tidak boleh sama dengan obat lain**
4. Klik **"💾 Update Obat"**

**Apa yang Bisa Diubah:**
- ✅ Semua field bisa diubah (termasuk kode, harga, stok)
- ✅ Stok bisa dikurangi/ditambahkan langsung di sini
- ❌ Kode tidak boleh duplikat dengan obat lain

---

### 5️⃣ HAPUS OBAT

**Akses:**
1. Di halaman Daftar, klik **🗑️** di kolom Aksi
2. Atau di halaman Detail, klik tombol **"🗑️ Hapus"**

**Proses:**
1. Klik tombol Hapus
2. Confirm dialog akan muncul: "Yakin ingin menghapus obat ini?"
3. Klik OK untuk hapus atau Cancel untuk batal

**Perhatian:**
- ⚠️ Obat **TIDAK BISA dihapus** jika sudah ada transaksi (pembelian/penjualan)
- ✅ Hanya obat yang belum pernah digunakan yang bisa dihapus
- 💾 Penghapusan bersifat **PERMANENT** (tidak bisa di-undo)

**Error jika Tidak Bisa Hapus:**
```
"Obat tidak dapat dihapus karena sudah terlibat dalam transaksi"
```

---

## 🎯 Contoh Workflow

### Scenario: Setup Data Obat Baru

**Langkah 1: Tambah Kategori** (jika belum ada)
- Ini dilakukan di menu Kategori (terpisah)

**Langkah 2: Tambah Obat**
```
1. Klik Obat > Tambah Obat
2. Isi:
   - Kode: MED-001
   - Nama: Paracetamol 500mg Tablet
   - Kategori: Analgesik
   - Unit: Tablet
   - Harga Beli: 500
   - Harga Jual: 1.000
   - Stok: 100
   - Min Stok: 10
3. Klik Simpan
```

**Langkah 3: Verifikasi**
```
1. Cari "Paracetamol" di daftar obat
2. Klik detail untuk melihat margin (100%)
3. Status harus "Aman" (stok 100 > min 10)
```

**Langkah 4: Export**
```
1. Di daftar obat, klik "Export CSV"
2. File didownload untuk backup/import
```

---

## ⚠️ Validasi & Error Messages

### Validasi Kode
```
Error: "Kode obat sudah terdaftar"
Solusi: Gunakan kode yang unik/belum digunakan
```

### Validasi Harga
```
Error: "Harga jual harus lebih besar dari harga beli"
Solusi: Pastikan harga jual >= harga beli
```

### Validasi Field Wajib
```
Error: "[Field] harus diisi"
Solusi: Isi semua field yang ditandai dengan * (asterisk)
```

### Validasi Hapus
```
Error: "Obat tidak dapat dihapus karena sudah terlibat dalam transaksi"
Solusi: Obat hanya bisa dihapus jika belum pernah digunakan
```

---

## 📊 Status Stok Explanation

| Status | Kondisi | Badge | Warna |
|--------|---------|-------|-------|
| Aman | Stok >= Min Stok | ✓ Aman | 🟢 Hijau |
| Rendah | Stok < Min Stok | ⚠️ Rendah | 🟡 Kuning |
| Kosong | Stok = 0 | ✗ Kosong | 🔴 Merah |

---

## 🔧 Tips & Tricks

### 1. Gunakan Kode Obat yang Konsisten
```
Format: MED-[Category]-[Number]
Contoh: MED-ANA-001 (Analgesik 001)
        MED-ANT-001 (Antibiotik 001)
```

### 2. Set Stok Minimum yang Tepat
```
Min Stok = Penjualan rata-rata per minggu × 2
Contoh: Jual 5 botol/minggu → Min Stok = 10 botol
```

### 3. Check Margin Keuntungan
```
Margin 20-30%: Normal
Margin < 20%: Harga jual terlalu rendah
Margin > 50%: Harga jual terlalu tinggi (cek kompetitor)
```

### 4. Monitor Stok Rendah
```
- Cek Dashboard untuk "Stok Rendah" alert
- Filter "Status Stok: Stok Rendah"
- Lakukan pembelian/restok
```

### 5. Gunakan Export CSV
```
- Backup data obat secara berkala
- Share ke tim/akuntan
- Import ke Excel untuk analisis lebih lanjut
```

---

## ❓ FAQ

**Q: Bisakah saya mengubah kode obat?**
A: Ya, tapi pastikan kode baru tidak duplikat dengan obat lain.

**Q: Apakah stok bisa negatif?**
A: Tidak, sistem tidak memperbolehkan stok negatif.

**Q: Bagaimana jika lupa minimum stok?**
A: Bisa di-update kapan saja melalui halaman Edit.

**Q: Bisa delete obat yang sudah terjual?**
A: Tidak, untuk menjaga integritas data transaksi.

**Q: Format file CSV bisa dibuka di mana?**
A: Excel, Google Sheets, atau text editor apapun.

**Q: Bagaimana jika ada typo di nama obat?**
A: Edit melalui halaman Edit, semua data akan terupdate otomatis.

---

## 🆘 Butuh Bantuan?

Lihat dokumentasi lengkap di: **MEDICINE_MANAGEMENT_GUIDE.md**

---

**Terakhir diupdate:** 5 Desember 2025
**Versi:** 1.0
