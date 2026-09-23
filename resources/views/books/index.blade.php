@extends('layout.app')

@section('title', 'Livres — Bibliothèque')

@section('content')
    <x-page-header title="Livres" wrapper-class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 border-bottom pb-3">
        {{ $books->total() }} {{ $books->total() > 1 ? 'livres' : 'livre' }}
        dans le catalogue.
        <x-slot:actions>
            <x-action-link :href="route('books.create')" icon="bi bi-plus-lg">Ajouter un livre</x-action-link>
        </x-slot:actions>
    </x-page-header>

    @if ($books->isEmpty())
        <x-empty-state icon="bi bi-inbox" title="Aucun livre pour le moment" :wrapped="false">
            Le catalogue est vide. Ajoutez un premier livre pour
            commencer.
            <x-slot:actions>
                <x-action-link :href="route('books.create')" icon="bi bi-plus-lg">Ajouter un livre</x-action-link>
            </x-slot:actions>
        </x-empty-state>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <caption class="visually-hidden">
                    Liste des livres du catalogue
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col" class="text-end">Pages</th>
                        <th scope="col" class="text-end">Quantité</th>
                        <th scope="col" class="text-end">Actions</th>
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
                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                    <x-action-link :href="route('books.show', $book->id)" icon="bi bi-eye" variant="btn btn-sm btn-outline-secondary">Afficher</x-action-link>
                                    <x-action-link :href="route('books.edit', $book->id)" icon="bi bi-pencil" variant="btn btn-sm btn-outline-primary">Modifier</x-action-link>
                                    <form
                                        action="{{ route('books.destroy', $book->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        data-confirm="Supprimer le livre « {{ $book->title }} » ?"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                        >
                                            <i class="bi bi-trash me-1" aria-hidden="true"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        {!! $books->links() !!}
        </div>
    @endif
@endsection
