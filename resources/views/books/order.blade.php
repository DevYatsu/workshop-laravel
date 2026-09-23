@extends('layout.app')

@section('title', 'Livres à commander — Bibliothèque')

@section('content')
    <x-page-header title="Livres à commander" wrapper-class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 border-bottom pb-3">
        Les livres dont le stock est épuisé.
        <x-slot:actions>
            <x-action-link :href="route('books.index')" icon="bi bi-arrow-left" variant="btn btn-outline-secondary">Retour aux livres</x-action-link>
        </x-slot:actions>
    </x-page-header>

    @if ($books->isEmpty())
        @if ($books->count() > 0)
        @else
            <x-empty-state icon="bi bi-check2-circle" icon-class="icon-accent" title="Aucun livre à commander" :wrapped="false">
                <h3 class="text-success">
                    Aucun livre n'a besoin d'être commandés pour l'instant!
                </h3>
            </x-empty-state>
        @endif
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <caption class="visually-hidden">
                    Livres dont le stock est épuisé
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col" class="text-end">Pages</th>
                        <th scope="col" class="text-end">Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $book->title }}</span>
                            </td>
                            <td>{{ $book->author->name ?? 'Auteur inconnu...' }}</td>
                            <td class="text-end text-body-secondary">
                                {{ $book->pages }}
                            </td>
                            <td class="text-end">
                                <x-stock-badge :quantity="$book->quantity" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        {!! $books->links() !!}
        </div>
    @endif
@endsection
