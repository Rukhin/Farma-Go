<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions (purchases and sales).
     */
    public function index(Request $request)
    {
        $query = $request->get('type', 'all'); // all, purchase, sale

        if ($query === 'purchase') {
            // Show only purchases with pagination
            $purchases = Purchase::with(['supplier', 'items.medicine'])->latest()->paginate(15);
            $sales = collect();
        } elseif ($query === 'sale') {
            // Show only sales with pagination
            $sales = Sale::with(['items.medicine'])->latest()->paginate(15);
            $purchases = collect();
        } else {
            // Show recent items from both (default view)
            $purchases = Purchase::with(['supplier', 'items.medicine'])->latest()->take(5)->get();
            $sales = Sale::with(['items.medicine'])->latest()->take(5)->get();
        }

        return view('transactions.index', compact('purchases', 'sales', 'query'));
    }

    /**
     * Show the form for creating a new purchase.
     */
    public function createPurchase()
    {
        return redirect()->route('purchases.create');
    }

    /**
     * Show the form for creating a new sale.
     */
    public function createSale()
    {
        return redirect()->route('sales.create');
    }
}