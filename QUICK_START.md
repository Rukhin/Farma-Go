# 🎯 QUICK START GUIDE

**Sistem Penjualan Obat - Laravel 12**

---

## ⚡ 3-STEP STARTUP

```powershell
# 1. Install dependencies (jika belum)
npm install && npm run build

# 2. Start server
php artisan serve --port=8000

# 3. Open browser
# http://127.0.0.1:8000
```

---

## 👤 LOGIN CREDENTIALS

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@apotek.com | password |
| Staff | kasir@apotek.com | password |

---

## 📱 MAIN MENU

### Admin Dashboard
```
Dashboard
├── Pembelian (Purchase CRUD)
├── Laporan (Reports: Pembelian, Penjualan, Stok)
├── User (User Management)
└── Profile
```

### Staff Dashboard
```
Dashboard
├── Pembelian (Purchase CRUD)
├── Penjualan (Sales CRUD)
└── Profile
```

---

## 🎯 KEY FEATURES

### 1️⃣ Pembelian (Purchase)
```
✅ Create purchase dengan multiple items
✅ Auto stock increment
✅ Database transactions
✅ Receipt view dengan struk

Path: /purchases
Admin & Staff access
```

### 2️⃣ Penjualan (Sales)
```
✅ Autocomplete search medicines
✅ Stock validation (prevent oversell)
✅ Auto stock decrement
✅ Calculate change (kembalian)
✅ Print receipt + PDF download

Path: /sales
Staff only
```

### 3️⃣ Laporan (Reports)
```
✅ Laporan Pembelian - filter by date range
✅ Laporan Penjualan - filter by date range
✅ Laporan Stok - filter by status
✅ PDF export untuk semua laporan
✅ Summary KPI cards

Path: /reports/purchases | /sales | /stock
Admin only
```

### 4️⃣ Dashboard
```
✅ 4 KPI Cards (Pembelian, Penjualan, Total Obat, Stok Rendah)
✅ Line Chart (Monthly Purchases vs Sales)
✅ Doughnut Chart (Stock Distribution)
✅ Stock Alert Box (Low stock items)

Path: /dashboard
All authenticated users
```

### 5️⃣ User Management
```
✅ CRUD staff users
✅ Password reset
✅ Role selection (admin/staff)
✅ Email unique validation
✅ Password strength validation

Path: /users
Admin only
```

---

## 🔍 COMMON TASKS

### Create a Purchase
```
1. Dashboard → Pembelian → + Tambah Pembelian
2. Select Supplier
3. Click "+ Tambah Baris" untuk add items
4. Select Obat, enter Qty & Price
5. Click "Simpan Pembelian"
6. Verify receipt & stock naik
```

### Create a Sale
```
1. Dashboard → Penjualan → + Tambah Penjualan
2. Search obat di autocomplete field
3. Enter Qty & Price
4. Click "+ Tambah Baris" untuk add items lagi
5. Enter Payment amount
6. Click "Simpan Penjualan"
7. Verify receipt & stock turun
```

### View Report with Filter
```
1. Dashboard → Laporan → [pilih laporan]
2. Enter Start Date & End Date
3. Click "Cari"
4. Click "📥 Export PDF" untuk download
```

### Create New Staff User
```
1. Dashboard → User → + Tambah User
2. Enter: Nama, Email, Password, Role
3. Click "Simpan"
4. Verify user appears di list
```

### Reset User Password
```
1. Dashboard → User
2. Click "Edit" pada user
3. Scroll ke "Reset Password" section
4. Enter password baru
5. Click "Reset Password"
```

---

## 📊 DATABASE INFO

**Seeded Sample Data:**
```
Users:
├── admin@apotek.com (role: admin)
└── kasir@apotek.com (role: staff)

Medicines (5):
├── Paracetamol 500mg (50 stock)
├── Ibuprofen 400mg (40 stock)
├── Paracetamol Sirup (30 stock)
├── Obat Maag Lambucin (35 stock)
└── Vitamin C 500mg (100 stock)

Categories (4):
├── Obat Sakit Kepala
├── Obat Demam
├── Obat Maag
└── Vitamin

Suppliers (2):
├── PT Kimia Pharma
└── Supplier Medan Jaya
```

---

## 🔧 USEFUL COMMANDS

```bash
# Fresh database
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear

# Tinker (interactive shell)
php artisan tinker

# List routes
php artisan route:list

# Check for errors
php artisan check

# Reset permissions
php artisan permission:reset
```

---

## 🐛 TROUBLESHOOTING

### "npm: The term 'npm' is not recognized"
```
→ Install Node.js dari https://nodejs.org/
→ Restart PowerShell
→ Run: npm install && npm run build
```

### "SQLSTATE[HY000]: General error"
```
→ Run: php artisan migrate:fresh --seed
→ Verify .env database settings
```

### "Views not loading"
```
→ Run: php artisan cache:clear
→ Check if views folder exists
→ Verify view names in controller
```

### "Chart not showing"
```
→ Check browser console for errors (F12)
→ Verify /reports/monthly-data endpoint works
→ Check Chart.js CDN is accessible
```

### "PDF export not working"
```
→ Verify barryvdh/laravel-dompdf installed:
   composer require barryvdh/laravel-dompdf
→ Check dompdf config in config/dompdf.php
```

---

## 📈 PERFORMANCE TIPS

```bash
# Optimize for production
php artisan optimize
php artisan config:cache
php artisan route:cache

# Clear compiled files (if issues)
php artisan optimize:clear
```

---

## 📚 DOCUMENTATION FILES

| File | Purpose |
|------|---------|
| **PROJECT_COMPLETION.md** | Full feature overview |
| **VERIFICATION_REPORT.md** | Requirements checklist |
| **IMPLEMENTATION_SUMMARY.md** | Technical details |
| **TESTING_GUIDE.md** | Detailed test scenarios |
| **QUICK_START.md** | This file |

---

## ✅ VERIFICATION CHECKLIST

Before starting, ensure:
```
☑ Laravel server running (php artisan serve --port=8000)
☑ Database migrated (php artisan migrate:fresh --seed)
☑ npm assets built (npm run build)
☑ Browser at http://127.0.0.1:8000
☑ Can login with test credentials
☑ Dashboard displays without errors
```

---

## 🆘 SUPPORT

**Issues found?**
1. Check console errors (F12 → Console)
2. Check server terminal for errors
3. Review relevant test guide section
4. Check troubleshooting above
5. Run: `php artisan cache:clear`

---

## 🚀 READY TO GO!

```
✅ All features implemented
✅ Database seeded
✅ Authentication ready
✅ Reports configured
✅ PDF export working

→ Start the server and begin testing!
→ See TESTING_GUIDE.md for detailed scenarios
→ Review IMPLEMENTATION_SUMMARY.md for architecture
```

**Enjoy! 🎉**
