<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the medicines.
     */
    public function index(Request $request)
    {
        $query = Medicine::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('medicine_category_id', $request->input('category_id'));
        }

        // Stock status filter
        if ($request->filled('stock_status')) {
            if ($request->input('stock_status') === 'low') {
                $query->whereRaw('stock < min_stock');
            } elseif ($request->input('stock_status') === 'empty') {
                $query->where('stock', 0);
            }
        }

        $medicines = $query->with('category')->paginate(15);
        $categories = MedicineCategory::all();

        return view('medicines.index', compact('medicines', 'categories'));
    }

    /**
     * Show the form for creating a new medicine.
     */
    public function create()
    {
        $categories = MedicineCategory::all();
        return view('medicines.create', compact('categories'));
    }

    /**
     * Store a newly created medicine in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        $validated = $request->validated();

        if ($validated['price_sale'] < $validated['price_purchase']) {
            return back()
                ->withInput()
                ->withErrors(['price_sale' => 'Harga jual harus lebih besar dari harga beli']);
        }

        Medicine::create($validated);

        return redirect()->route('medicines.index')
                        ->with('success', 'Obat berhasil ditambahkan');
    }

    /**
     * Display the specified medicine.
     */
    public function show(Medicine $medicine)
    {
        $medicine->load('category');
        return view('medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified medicine.
     */
    public function edit(Medicine $medicine)
    {
        $categories = MedicineCategory::all();
        return view('medicines.edit', compact('medicine', 'categories'));
    }

    /**
     * Update the specified medicine in storage.
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $validated = $request->validated();

        if ($validated['price_sale'] < $validated['price_purchase']) {
            return back()
                ->withInput()
                ->withErrors(['price_sale' => 'Harga jual harus lebih besar dari harga beli']);
        }

        $medicine->update($validated);

        return redirect()->route('medicines.index')
                        ->with('success', 'Obat berhasil diperbarui');
    }

    /**
     * Remove the specified medicine from storage.
     */
    public function destroy(Medicine $medicine)
    {
        // Check if medicine has transactions
        if ($medicine->purchaseItems()->exists() || $medicine->saleItems()->exists()) {
            return redirect()->route('medicines.index')
                            ->with('error', 'Obat tidak dapat dihapus karena sudah terlibat dalam transaksi');
        }

        $medicine->delete();

        return redirect()->route('medicines.index')
                        ->with('success', 'Obat berhasil dihapus');
    }

    /**
     * Export medicines to CSV
     */
    public function export()
    {
        $medicines = Medicine::with('category')->get();

        $filename = "obat_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename"
        );

        $callback = function() use ($medicines) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['Kode', 'Nama', 'Kategori', 'Unit', 'Harga Beli', 'Harga Jual', 'Stok', 'Min Stok', 'Deskripsi']);
            
            // Data
            foreach ($medicines as $medicine) {
                fputcsv($file, [
                    $medicine->code,
                    $medicine->name,
                    $medicine->category->name ?? '-',
                    $medicine->unit,
                    $medicine->price_purchase,
                    $medicine->price_sale,
                    $medicine->stock,
                    $medicine->min_stock,
                    $medicine->description ?? '-'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk update stock
     */
    public function bulkUpdateStock(Request $request)
    {
        $validated = $request->validate([
            'updates' => 'required|array',
            'updates.*.id' => 'required|exists:medicines,id',
            'updates.*.stock' => 'required|integer|min:0',
        ]);

        foreach ($validated['updates'] as $update) {
            Medicine::find($update['id'])->update(['stock' => $update['stock']]);
        }

        return redirect()->route('medicines.index')
                        ->with('success', 'Stok berhasil diperbarui');
    }
}
