<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = \App\Models\Book::with('author')->latest()->paginate(5);
        return view('books.index', ['books' => $books])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the books that are out of stock.
     */
    public function order()
    {
        $books = \App\Models\Book::with('author')->latest()->where('quantity', '<=', 0)->paginate(5);

        return view('books.order', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = \App\Models\Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Messages are passed inline because the app locale is "en" and there
        // is no lang/ directory, so the framework defaults would be English.
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages(),
        );

        \App\Models\Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Livre créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = \App\Models\Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = \App\Models\Book::where('id', $id)->firstOrFail();
        $authors = \App\Models\Author::all();
        return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages(),
        );

        \App\Models\Book::findOrFail($id)->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Livre modifié avec succès.');
    }

    /**
     * Validation rules shared by store() and update() (TODO-6-0).
     */
    private function validationRules(): array
    {
        return [
            'title' => ['required', 'string', 'min:6', 'max:25'],
            'pages' => ['required', 'integer', 'gt:0', 'lt:1000'],
            'quantity' => ['required', 'integer', 'gte:0', 'lt:100'],
            'author_id' => 'nullable|integer|exists:authors,id',
        ];
    }

    /**
     * French messages (app locale is "en" with no lang/ directory).
     */
    private function validationMessages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.string' => 'Le titre doit être un texte.',
            'title.min' => 'Le titre doit contenir au moins 6 caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 25 caractères.',
            'pages.required' => 'Le nombre de pages est obligatoire.',
            'pages.integer' => 'Le nombre de pages doit être un nombre entier.',
            'pages.gt' => 'Le nombre de pages doit être supérieur à 0.',
            'pages.lt' => 'Le nombre de pages doit être inférieur à 1000.',
            'quantity.required' => 'La quantité est obligatoire.',
            'quantity.integer' => 'La quantité doit être un nombre entier.',
            'quantity.gte' => 'La quantité ne peut pas être négative.',
            'quantity.lt' => 'La quantité doit être inférieure à 100.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = \App\Models\Book::find($id);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Livre supprimé avec succès.');
    }
}
