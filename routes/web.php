<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Medicine;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Medicines Management (admin or staff can access)
    Route::resource('medicines', MedicineController::class);
    Route::get('medicines/export/csv', [MedicineController::class, 'export'])->name('medicines.export');
    Route::post('medicines/bulk-update-stock', [MedicineController::class, 'bulkUpdateStock'])->name('medicines.bulkUpdateStock');

    // Transactions (combined purchases and sales)
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create-purchase', [TransactionController::class, 'createPurchase'])->name('transactions.createPurchase');
    Route::get('transactions/create-sale', [TransactionController::class, 'createSale'])->name('transactions.createSale');

    // Purchases (admin or staff can access)
    Route::resource('purchases', PurchaseController::class);

    // Sales (admin can view, staff can manage)
    Route::resource('sales', SaleController::class)->except(['create', 'store']);
    Route::middleware(['staff'])->group(function () {
        Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
        Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
        Route::get('sales/{sale}/receipt-pdf', [SaleController::class, 'receiptPdf'])->name('sales.receipt-pdf');
    });

    // Medicine autocomplete/search for transactions
    Route::get('medicines/search', function (Request $request) {
        $q = $request->query('q', '');
        $items = Medicine::where('name', 'like', "%{$q}%")
            ->orWhere('code', 'like', "%{$q}%")
            ->limit(15)
            ->get(['id','code','name','price_sale','stock']);
        return response()->json($items);
    })->name('medicines.search');

    // Dashboard stats API
    Route::get('dashboard/stats', function () {
        return response()->json([
            'total_medicines' => Medicine::count(),
            'low_stock_count' => Medicine::whereRaw('stock < min_stock')->count(),
        ]);
    })->name('dashboard.stats');

    // Reports (all authenticated users)
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/purchases', [ReportController::class, 'purchases'])->name('purchases');
        Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('/stock/distribution', [ReportController::class, 'stockDistribution'])->name('stock-distribution');
        Route::get('/monthly-data', [ReportController::class, 'monthlyData'])->name('monthly-data');
        Route::get('/stock-alerts', [ReportController::class, 'stockAlerts'])->name('stock-alerts');
        Route::get('/purchases/pdf', [ReportController::class, 'purchasesPdf'])->name('purchases-pdf');
        Route::get('/sales/pdf', [ReportController::class, 'salesPdf'])->name('sales-pdf');
        Route::get('/stock/pdf', [ReportController::class, 'stockPdf'])->name('stock-pdf');
    });

    // User Management (admin only)
    Route::resource('users', UserController::class);
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});

require __DIR__.'/auth.php';
