<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    /**
     * Show purchase report with date range filter
     */
    public function purchases(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'] ? Carbon::parse($validated['start_date'])->startOfDay() : now()->startOfMonth();
        $endDate = $validated['end_date'] ? Carbon::parse($validated['end_date'])->endOfDay() : now()->endOfDay();

        $purchases = Purchase::whereBetween('date', [$startDate, $endDate])
            ->with(['supplier', 'items.medicine', 'user'])
            ->orderBy('date', 'desc')
            ->paginate(15);

        $summary = Purchase::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as total_transactions, SUM(total) as total_amount')
            ->first();

        return view('reports.purchases', compact('purchases', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Show sales report with date range filter
     */
    public function sales(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'] ? Carbon::parse($validated['start_date'])->startOfDay() : now()->startOfMonth();
        $endDate = $validated['end_date'] ? Carbon::parse($validated['end_date'])->endOfDay() : now()->endOfDay();

        $sales = Sale::whereBetween('date', [$startDate, $endDate])
            ->with(['items.medicine', 'user'])
            ->orderBy('date', 'desc')
            ->paginate(15);

        $summary = Sale::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as total_transactions, SUM(total) as total_amount, SUM(payment - total) as total_change')
            ->first();

        return view('reports.sales', compact('sales', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Show stock report with filter for medicines below minimum stock
     */
    public function stock(Request $request)
    {
        $showOnlyBelowMin = $request->boolean('below_min', false);

        $medicines = Medicine::with('category')
            ->when($showOnlyBelowMin, function ($query) {
                return $query->whereRaw('stock < min_stock');
            })
            ->orderBy('name')
            ->paginate(20);

        $summary = [
            'total_medicines' => Medicine::count(),
            'below_minimum' => Medicine::whereRaw('stock < min_stock')->count(),
            'out_of_stock' => Medicine::where('stock', 0)->count(),
            'total_stock_value' => Medicine::selectRaw('SUM(stock * price_sale) as value')->first()->value ?? 0,
        ];

        return view('reports.stock', compact('medicines', 'summary', 'showOnlyBelowMin'));
    }

    /**
     * Get monthly sales/purchase data for chart (API endpoint)
     */
    public function monthlyData(Request $request)
    {
        $year = $request->query('year', now()->year);
        
        // Monthly purchases
        $purchases = Purchase::whereYear('date', $year)
            ->selectRaw('MONTH(date) as month, SUM(total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Monthly sales
        $sales = Sale::whereYear('date', $year)
            ->selectRaw('MONTH(date) as month, SUM(total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Fill missing months with 0
        $months = collect(range(1, 12));
        $purchaseData = $months->map(fn($m) => $purchases[$m] ?? 0)->values();
        $salesData = $months->map(fn($m) => $sales[$m] ?? 0)->values();

        return response()->json([
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'purchases' => $purchaseData,
            'sales' => $salesData,
        ]);
    }

    /**
     * Get stock below minimum alert data (API endpoint)
     */
    public function stockAlerts()
    {
        $lowStocks = Medicine::where('stock', '<', DB::raw('min_stock'))
            ->select('id', 'code', 'name', 'stock', 'min_stock')
            ->orderBy('stock')
            ->limit(10)
            ->get();

        return response()->json($lowStocks);
    }

    /**
     * Get stock distribution counts (API endpoint)
     */
    public function stockDistribution()
    {
        $total = Medicine::count();
        $outOfStock = Medicine::where('stock', 0)->count();
        $low = Medicine::where('stock', '>', 0)
            ->whereRaw('stock < min_stock')
            ->count();
        $normal = max(0, $total - $low - $outOfStock);

        return response()->json([
            'total' => $total,
            'normal' => $normal,
            'low' => $low,
            'out_of_stock' => $outOfStock,
        ]);
    }

    /**
     * Export purchases to PDF
     */
    public function purchasesPdf(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'] ? Carbon::parse($validated['start_date'])->startOfDay() : now()->startOfMonth();
        $endDate = $validated['end_date'] ? Carbon::parse($validated['end_date'])->endOfDay() : now()->endOfDay();

        $purchases = Purchase::whereBetween('date', [$startDate, $endDate])
            ->with(['supplier', 'items.medicine', 'user'])
            ->orderBy('date', 'desc')
            ->get();

        $summary = Purchase::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as total_transactions, SUM(total) as total_amount')
            ->first();

        $pdf = PDF::loadView('reports.purchases-pdf', compact('purchases', 'summary', 'startDate', 'endDate'));
        return $pdf->download('laporan-pembelian-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export sales to PDF
     */
    public function salesPdf(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'] ? Carbon::parse($validated['start_date'])->startOfDay() : now()->startOfMonth();
        $endDate = $validated['end_date'] ? Carbon::parse($validated['end_date'])->endOfDay() : now()->endOfDay();

        $sales = Sale::whereBetween('date', [$startDate, $endDate])
            ->with(['items.medicine', 'user'])
            ->orderBy('date', 'desc')
            ->get();

        $summary = Sale::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('COUNT(*) as total_transactions, SUM(total) as total_amount, SUM(payment - total) as total_change')
            ->first();

        $pdf = PDF::loadView('reports.sales-pdf', compact('sales', 'summary', 'startDate', 'endDate'));
        return $pdf->download('laporan-penjualan-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export stock report to PDF
     */
    public function stockPdf(Request $request)
    {
        $showOnlyBelowMin = $request->boolean('below_min', false);

        $medicines = Medicine::with('category')
            ->when($showOnlyBelowMin, function ($query) {
                return $query->whereRaw('stock < min_stock');
            })
            ->orderBy('name')
            ->get();

        $summary = [
            'total_medicines' => Medicine::count(),
            'below_minimum' => Medicine::whereRaw('stock < min_stock')->count(),
            'out_of_stock' => Medicine::where('stock', 0)->count(),
            'total_stock_value' => Medicine::selectRaw('SUM(stock * price_sale) as value')->first()->value ?? 0,
        ];

        $pdf = PDF::loadView('reports.stock-pdf', compact('medicines', 'summary', 'showOnlyBelowMin'));
        return $pdf->download('laporan-stok-' . now()->format('Y-m-d') . '.pdf');
    }
}
