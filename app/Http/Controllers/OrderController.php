<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Stock level at or below which a book is considered low and must be
     * reordered. One single source of truth, reused by index() and its view.
     */
    private const LOW_STOCK_THRESHOLD = 2;

    /**
     * Display a listing of the books that need reordering.
     */
    public function index()
    {
        // Rule: a book needs reordering when its stock is at or below
        // LOW_STOCK_THRESHOLD (quantity <= 2). The lowest stock comes first.
        $books = Book::where('quantity', '<=', self::LOW_STOCK_THRESHOLD)
            ->orderBy('quantity')
            ->orderBy('title')
            ->paginate(10);

        $orders = []; // \App\Models\Order::all();

        return view('orders', [
            'books' => $books,
            'orders' => $orders,
            'threshold' => self::LOW_STOCK_THRESHOLD,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Order creation is not part of the workshop scope yet. Redirect back
        // with a message instead of returning null (which would 500).
        return redirect()->route('orders.index')
            ->with('error', "La création d'une commande n'est pas encore disponible.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('orders.show', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('orders.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('orders.index')
            ->with('error', "La modification d'une commande n'est pas encore disponible.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('orders.index')
            ->with('error', "La suppression d'une commande n'est pas encore disponible.");
    }
}
