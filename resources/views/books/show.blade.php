@extends('layout.app')

@section('title', 'Afficher un livre — Bibliothèque')

@section('content')
    @php
        // show() uses findOrFail, so $book is normally set. This guard keeps
        // the view from throwing if it is ever included without a book.
        $book = $book ?? null;
    @endphp

    <x-page-header title="Afficher un livre" wrapper-class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 border-bottom pb-3">
        Fiche détaillée du livre.
        <x-slot:actions>
            <x-action-link :href="route('books.index')" icon="bi bi-arrow-left" variant="btn btn-sm btn-outline-secondary">Retour</x-action-link>
        </x-slot:actions>
    </x-page-header>

    @if (is_null($book))
        <div class="alert alert-warning d-flex align-items-start" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 mt-1" aria-hidden="true"></i>
            <div>Livre introuvable.</div>
        </div>
    @else
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <span>
                            <i class="bi bi-journal-text me-1" aria-hidden="true"></i>
                            Livre <span class="text-body-tertiary">#{{ $book->id }}</span>
                        </span>
                        <span class="badge badge-neutral">{{ $book->title }}</span>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-5 text-body-secondary fw-normal">
                                Titre
                            </dt>
                            <dd class="col-sm-7 fw-semibold">{{ $book->title }}</dd>

                            <dt class="col-sm-5 text-body-secondary fw-normal">
                                Nombre de pages
                            </dt>
                            <dd class="col-sm-7">{{ $book->pages }}</dd>

                            <dt class="col-sm-5 text-body-secondary fw-normal">
                                Quantité
                            </dt>
                            <dd class="col-sm-7">
                                <x-stock-badge :quantity="$book->quantity" ok-class="badge-stock-ok" />
                            </dd>
                        </dl>
                    </div>
                    <div class="card-footer d-flex flex-wrap gap-2">
                        <x-action-link :href="route('books.edit', $book->id)" icon="bi bi-pencil" variant="btn btn-sm btn-outline-primary">Modifier</x-action-link>
                        <form
                            action="{{ route('books.destroy', $book->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Supprimer le livre « {{ addslashes($book->title) }} » ?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash me-1" aria-hidden="true"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
