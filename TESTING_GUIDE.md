# 🧪 TESTING GUIDE - Sistem Penjualan Obat Laravel 12

**Tanggal:** 5 Desember 2025  
**Status:** ✅ Ready for Testing

---

## 🎯 PRE-REQUISITES

### 1. Install npm Assets (URGENT)
```powershell
# Install Node.js dari https://nodejs.org/ terlebih dahulu
npm install
npm run build
```

### 2. Start Laravel Server
```powershell
php artisan serve --port=8000
```

Server akan berjalan di: **http://127.0.0.1:8000**

### 3. Test Users Available
```
1. Admin User:
   Email: admin@apotek.com
   Password: password
   Role: Admin

2. Staff/Kasir User:
   Email: kasir@apotek.com
   Password: password
   Role: Staff
```

---

## 📋 TESTING SCENARIOS

### TEST 1: LOGIN & AUTHENTICATION

**Objective:** Verify login system dan role-based access

#### Steps:
```
1. Open http://127.0.0.1:8000
2. Click Login (atau /login di URL)
3. Enter: admin@apotek.com / password
4. Expected: Redirect ke dashboard dengan Welcome message "Selamat datang, Admin User (admin)"
5. Verify menu shows: Dashboard, Pembelian, Laporan, User
6. Logout dan login dengan kasir@apotek.com
7. Verify menu shows: Dashboard, Pembelian, Penjualan (tidak ada Laporan/User)
```

#### Expected Results:
- ✅ Admin bisa akses semua menu
- ✅ Staff hanya bisa akses Pembelian & Penjualan
- ✅ Session terekam dengan benar

---

### TEST 2: DASHBOARD ENHANCEMENTS

**Objective:** Verify dashboard charts, KPI cards, dan stock alerts

#### Steps (Login as Admin):
```
1. Go to Dashboard (Home)
2. Verify 4 Summary Cards muncul:
   - Pembelian Bulan Ini
   - Penjualan Bulan Ini
   - Total Obat
   - Stok Rendah
3. Verify Line Chart shows:
   - 12 months (Jan-Dec)
   - Pembelian line (blue)
   - Penjualan line (green)
4. Verify Doughnut Chart shows:
   - Normal (green segment)
   - Rendah (orange segment)
   - Habis (red segment)
5. Scroll down, verify Stock Alert box appears (if any low stock)
   - Yellow background
   - List obat dengan stok rendah
6. Verify action cards (Pembelian + Laporan untuk admin)
```

#### Expected Results:
- ✅ Semua chart load dengan data yang tepat
- ✅ KPI cards menunjukkan angka dari database
- ✅ Stock alert conditional (hanya muncul jika ada stok rendah)
- ✅ Chart responsive dan readable

---

### TEST 3: LAPORAN PEMBELIAN

**Objective:** Verify laporan pembelian dengan filter & export

#### Steps (Login as Admin):
```
1. Click "Laporan" di menu
2. Select "Laporan Pembelian" (atau ke /reports/purchases)
3. Leave date filter kosong (akan default ke bulan ini)
4. Verify tabel muncul dengan kolom:
   - Invoice, Supplier, Tanggal, Item, Total
5. Verify summary cards:
   - Total Transaksi
   - Total Pembelian (Rp format)
6. Test Date Filter:
   - Pilih Start Date: 01/12/2025
   - Pilih End Date: 31/12/2025
   - Click "Cari"
   - Data harusnya filter sesuai range
7. Click "📥 Export PDF"
   - File "laporan-pembelian-YYYY-MM-DD.pdf" should download
   - Open PDF dan verify:
     * Header "LAPORAN PEMBELIAN OBAT"
     * Periode dates
     * Table dengan data
     * Summary footer
```

#### Expected Results:
- ✅ Data muncul di tabel dengan benar
- ✅ Filter date range works
- ✅ PDF export creates file successfully
- ✅ PDF formatting professional

---

### TEST 4: LAPORAN PENJUALAN

**Objective:** Verify laporan penjualan dengan filter & export

#### Steps (Login as Admin):
```
1. Click "Laporan" di menu
2. Select "Laporan Penjualan"
3. Filter by date range (contoh: 01/12/2025 - 31/12/2025)
4. Verify summary cards:
   - Total Transaksi
   - Total Penjualan
   - Total Kembalian
5. Verify tabel dengan: Invoice, Kasir, Tanggal, Item, Total
6. Click detail sales (link "Lihat" di tabel)
   - Should show receipt view
7. Click "📥 Export PDF"
   - File "laporan-penjualan-YYYY-MM-DD.pdf" should download
```

#### Expected Results:
- ✅ Summary calculations correct
- ✅ Filter works properly
- ✅ PDF export successful
- ✅ Total penjualan >= 0

---

### TEST 5: LAPORAN STOK OBAT

**Objective:** Verify laporan stok dengan status dan filter

#### Steps (Login as Admin):
```
1. Click "Laporan" di menu
2. Select "Laporan Stok"
3. Verify summary cards (4 cards):
   - Total Obat: 5 (sesuai seeder)
   - Stok Normal
   - Stok Rendah
   - Stok Habis
4. Verify tabel dengan kolom:
   - Kode, Nama Obat, Kategori, Stok, Min, Status
5. Verify status badges:
   - Green: Normal
   - Orange: Rendah (stock < min_stock)
   - Red: Habis (stock = 0)
6. Check checkbox "Tampilkan hanya stok di bawah minimum"
   - Click Filter
   - Data harusnya hanya show obat dengan stock < min_stock
7. Click "📥 Export PDF"
   - Verify PDF downloads successfully
   - Check content di PDF
```

#### Expected Results:
- ✅ Status indicators color correctly
- ✅ Filter checkbox works
- ✅ PDF contains all medicines atau filtered only
- ✅ Summary cards calculate correctly

---

### TEST 6: USER MANAGEMENT

**Objective:** Verify user CRUD & admin-only access

#### Steps (Login as Admin):
```
1. Click "User" di menu navigasi
2. Verify list of staff users shows
   - Default: kasir@apotek.com (Staff)
3. Click "+ Tambah User"
4. Fill form:
   - Nama: Test User
   - Email: testuser@apotek.com
   - Password: TestPassword123!
   - Role: Staff
5. Click "Simpan"
   - Should redirect ke users list dengan success message
   - Verify "Test User" appears di list
6. Click "Edit" pada user baru
7. Update:
   - Nama: Test User Updated
   - Click "Perbarui"
   - Verify update successful
8. Test Password Reset:
   - Scroll down to "Reset Password" section
   - Enter new password: NewPassword123!
   - Click "Reset Password"
   - Message should show success
9. Click "Hapus" on test user
   - Confirm deletion
   - User should disappear from list
10. Test admin-only access:
    - Logout
    - Login as kasir@apotek.com
    - Try to go /users
    - Expected: 403 Forbidden error
```

#### Expected Results:
- ✅ CRUD operations work (Create, Read, Update, Delete)
- ✅ Form validation works (email unique, password strength)
- ✅ Password reset updates password
- ✅ Staff cannot access user management (403 error)
- ✅ Cannot delete admin users
- ✅ Role dropdown updates correctly

---

### TEST 7: PEMBELIAN FLOW (Existing Feature)

**Objective:** Verify pembelian masih berfungsi dengan baik

#### Steps (Login as Admin):
```
1. Click "Pembelian" di menu
2. Click "+ Tambah Pembelian"
3. Select Supplier: PT Kimia Pharma
4. Select Tanggal: hari ini (auto-filled)
5. Click "+ Tambah Baris"
6. Dropdown obat, pilih: Paracetamol 500mg
7. Qty: 10
8. Harga: 10000
9. Click "+ Tambah Baris" lagi
10. Pilih obat lain: Ibuprofen 400mg
11. Qty: 5
12. Harga: 12000
13. Click "Simpan Pembelian"
14. Verify receipt shows:
    - Invoice (PO timestamp)
    - Supplier info
    - Items tabel
    - Total kalkulasi benar
15. Verify stok bertambah:
    - Go ke Laporan Stok
    - Paracetamol seharusnya stok naik 10
    - Ibuprofen seharusnya stok naik 5
```

#### Expected Results:
- ✅ Form validation works
- ✅ Dynamic item adder works
- ✅ Total calculation correct
- ✅ Stock increment successful
- ✅ Receipt displays correctly

---

### TEST 8: PENJUALAN FLOW (Existing Feature)

**Objective:** Verify penjualan dengan autocomplete & stock validation

#### Steps (Login as Staff/Kasir):
```
1. Click "Penjualan" di menu
2. Click "+ Tambah Penjualan"
3. Search field: type "paracetamol"
   - Expected: Autocomplete dropdown shows matching medicines
4. Click result "Paracetamol 500mg"
   - Should add to table
   - Auto-fill price_sale (15000)
5. Qty: 5
6. Payment: 100000
7. Click "+ Tambah Baris"
8. Search "ibuprofen"
9. Click result "Ibuprofen 400mg"
10. Qty: 3
11. Click "Simpan Penjualan"
12. Verify receipt shows:
    - Invoice (SO timestamp)
    - Kasir name
    - Items dengan qty & harga
    - Calculation:
      * Item 1: 5 x 15000 = 75000
      * Item 2: 3 x 18000 = 54000
      * Total: 129000
      * Payment: 100000 (INPUT tapi harusnya > total)
    - ERROR message should appear: "Payment must be >= total"
13. Edit payment to: 150000
14. Click "Simpan Penjualan"
15. Verify receipt:
    - Total: 129000
    - Payment: 150000
    - Kembalian: 21000
16. Click "📥 Download PDF"
    - Receipt PDF should download
    - Filename: "struk-SO[timestamp].pdf"
17. Click "Cetak Struk"
    - Print dialog opens
18. Verify stock decreased:
    - Go ke Laporan Stok
    - Paracetamol: 50 - 5 = 45
    - Ibuprofen: 40 - 3 = 37
```

#### Expected Results:
- ✅ Autocomplete search works
- ✅ Dynamic item adder works
- ✅ Total calculation correct
- ✅ Stock validation prevents oversell
- ✅ Kembalian calculation correct
- ✅ Stock decrement successful
- ✅ PDF receipt downloads
- ✅ Print dialog works

---

### TEST 9: STOCK VALIDATION (Critical)

**Objective:** Verify sistem mencegah penjualan melebihi stok

#### Steps (Login as Staff):
```
1. Go to Penjualan
2. Create sale dengan:
   - Obat: Paracetamol Sirup (stok sekarang 30)
   - Qty: 40 (lebih dari stok)
   - Payment: 1000000
3. Click "Simpan Penjualan"
4. Expected: ERROR message appears
   - "Stock not sufficient for Paracetamol Sirup"
5. Form harus kembali ke input (withInput())
6. Verify stok NOT berkurang (database check)
7. Change qty to 20 (kurang dari 30)
8. Click "Simpan Penjualan"
9. Expected: SUCCESS - penjualan tersimpan
10. Verify stok berkurang dari 30 → 10
```

#### Expected Results:
- ✅ Oversell validation works
- ✅ Error message clear
- ✅ Stock tidak berkurang saat error
- ✅ Stock berkurang saat success
- ✅ Database transaction ensures consistency

---

### TEST 10: PDF EXPORT QUALITY

**Objective:** Verify PDF formatting dan content quality

#### Steps:
```
1. Download PDF laporan pembelian
   - Check header "LAPORAN PEMBELIAN OBAT"
   - Check periode dates correct
   - Check table borders dan alignment
   - Check currency format "Rp X.XXX.XXX"
   - Check summary cards at bottom
   - Check footer text

2. Download PDF laporan penjualan
   - Same checks as above
   - Verify column order correct
   - Verify summary shows Transaksi + Amount + Kembalian

3. Download PDF laporan stok
   - Check table dengan Kode, Nama, Kategori, Stok, Min, Status
   - Check status badges colored correctly
   - Check summary cards at top

4. Download receipt PDF (sales)
   - Check receipt format narrow (80mm thermal printer width)
   - Check items table
   - Check calculation summary
   - Check "Terima kasih telah berbelanja" footer
   - Test print compatibility (should print without issue)

5. Print test:
   - Open PDF di Windows Preview
   - Send to print
   - Verify output quality
```

#### Expected Results:
- ✅ PDF files generate without errors
- ✅ Content complete dan accurate
- ✅ Formatting professional
- ✅ Currency formatting consistent
- ✅ Print output readable

---

## 🔍 ADDITIONAL TESTS

### TEST 11: Responsive Design

**Steps:**
```
1. Open browser DevTools (F12)
2. Toggle device toolbar (mobile view)
3. Test views on:
   - Mobile (375px)
   - Tablet (768px)
   - Desktop (1024px)
4. Verify:
   - Navigation responsive (hamburger menu)
   - Tables scrollable on mobile
   - Forms full width
   - Buttons aligned properly
```

#### Expected Results:
- ✅ Mobile layout readable
- ✅ No horizontal scroll
- ✅ Touch targets large enough

---

### TEST 12: Form Validation

**Steps:**
```
1. Create user form:
   - Submit empty form → validation errors
   - Enter duplicate email → unique validation
   - Password < 8 chars → validation error
   - Password no numbers → validation error
   - Password no symbols → validation error

2. Report filter:
   - End date < start date → validation error
   - Invalid date format → validation error

3. Purchase/Sale forms:
   - Submit without items → validation error
   - Item qty 0 → validation error
   - Item price < 0 → validation error
```

#### Expected Results:
- ✅ All validations work
- ✅ Error messages clear dan helpful
- ✅ Data preserved on error (withInput)

---

### TEST 13: Performance

**Steps:**
```
1. Open Chrome DevTools Network tab
2. Load Dashboard
   - Check: load time < 3 seconds
   - Check: main file sizes reasonable
   - Check: chart load smoothly

3. Load report dengan 100+ items
   - Pagination works
   - Page load < 2 seconds
   - No memory leaks
```

#### Expected Results:
- ✅ Dashboard responsive
- ✅ Reports load quickly
- ✅ Pagination works
- ✅ Charts render smoothly

---

## 📋 BUG REPORT TEMPLATE

Jika menemukan bug:

```
Title: [Component] Brief description

Environment:
- Browser: Chrome/Firefox/Safari/Edge
- Device: Desktop/Mobile
- OS: Windows/Mac/Linux

Steps to Reproduce:
1. ...
2. ...
3. ...

Expected Result:
...

Actual Result:
...

Screenshots/Videos:
(attach if possible)
```

---

## ✅ FINAL CHECKLIST

Sebelum go-live:

- [ ] Npm build complete (`npm run build`)
- [ ] Server running (`php artisan serve`)
- [ ] Database fresh (`php artisan migrate:fresh --seed`)
- [ ] Semua TEST SCENARIOS completed dengan pass
- [ ] No console errors
- [ ] No 404 errors di network tab
- [ ] Responsive design OK di mobile
- [ ] PDF exports working
- [ ] Stock validation working
- [ ] User permissions working (admin/staff)
- [ ] Authentication secure

---

## 🎓 QUICK REFERENCE

### Important URLs
```
Dashboard:          http://127.0.0.1:8000
Login:              http://127.0.0.1:8000/login
Admin Dashboard:    http://127.0.0.1:8000/dashboard
Laporan:            http://127.0.0.1:8000/reports/stock
User Management:    http://127.0.0.1:8000/users
Pembelian:          http://127.0.0.1:8000/purchases
Penjualan:          http://127.0.0.1:8000/sales
```

### Test Credentials
```
Admin:  admin@apotek.com / password
Staff:  kasir@apotek.com / password
```

### Useful Artisan Commands
```bash
# Clear cache
php artisan cache:clear

# Reset database
php artisan migrate:fresh --seed

# Check routes
php artisan route:list

# Tinker (REPL)
php artisan tinker
```

---

**Good luck with testing! 🚀**

Report any issues untuk perbaikan cepat.
