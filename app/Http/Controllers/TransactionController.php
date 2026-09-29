<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('pos.create', ['products' => $products]);
    }

    public function store()
    {
        return 'Transaksi disimpan (belum ada logika penyimpanan)';
    }

    public function index()
    {
        $transactions = DB::table('transactions')
            ->whereBetween('created_at', ['2026-09-01', '2026-09-30'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    public function show(string $id)
    {
        return "Detail transaksi #{$id}";
    }
}