<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->latest()->paginate(20);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $medicines = Medicine::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('purchases.create', compact('medicines','suppliers'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $purchase = Purchase::create([
                'invoice' => 'PO'.time(),
                'supplier_id' => $data['supplier_id'] ?? null,
                'user_id' => $request->user()->id,
                'date' => $data['date'] ?? now(),
                'total' => 0,
            ]);

            $total = 0;
            foreach ($data['items'] as $item) {
                $medicine = Medicine::findOrFail($item['medicine_id']);
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];
                $subtotal = $qty * $price;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                // increase stock
                $medicine->increment('stock', $qty);

                $total += $subtotal;
            }

            $purchase->update(['total' => $total]);

            DB::commit();

            return redirect()->route('purchases.show', $purchase)->with('success', 'Purchase saved.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load('items.medicine', 'supplier', 'items');
        return view('purchases.show', compact('purchase'));
    }
}
