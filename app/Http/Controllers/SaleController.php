<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->latest()->paginate(20);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $medicines = Medicine::where('stock', '>', 0)->orderBy('name')->get();
        return view('sales.create', compact('medicines'));
    }

    public function store(StoreSaleRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Validate stock availability
            foreach ($data['items'] as $item) {
                $medicine = Medicine::findOrFail($item['medicine_id']);
                if ($medicine->stock < (int) $item['quantity']) {
                    return back()->withErrors(['stock' => "Stock not sufficient for {$medicine->name}"])->withInput();
                }
            }

            $sale = Sale::create([
                'invoice' => 'SO'.time(),
                'user_id' => $request->user()->id,
                'date' => $data['date'] ?? now(),
                'total' => 0,
                'payment' => $data['payment'] ?? null,
                'change' => null,
            ]);

            $total = 0;
            foreach ($data['items'] as $item) {
                $medicine = Medicine::findOrFail($item['medicine_id']);
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];
                $subtotal = $qty * $price;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                // decrease stock
                $medicine->decrement('stock', $qty);

                $total += $subtotal;
            }

            $sale->update(['total' => $total]);

            DB::commit();

            return redirect()->route('sales.show', $sale)->with('success', 'Sale recorded.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('items.medicine', 'user');
        return view('sales.show', compact('sale'));
    }

    /**
     * Export sale receipt to PDF
     */
    public function receiptPdf(Sale $sale)
    {
        $sale->load('items.medicine', 'user');
        $pdf = PDF::loadView('sales.receipt-pdf', compact('sale'));
        return $pdf->download('struk-' . $sale->invoice . '.pdf');
    }
}
