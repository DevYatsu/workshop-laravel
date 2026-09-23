@extends('layout.app')

{{-- @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Book[] $books --}}
{{-- @var int $threshold --}}

@section('title', 'Livres à commander — Bibliothèque')

@section('content')
    <x-page-header title="Livres à commander" wrapper-class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 border-bottom pb-3">
        Les livres dont le stock est bas ou épuisé.
        <x-slot:actions>
            <x-action-link :href="route('books.index')" icon="bi bi-journal-text" variant="btn btn-outline-secondary">Voir tous les livres</x-action-link>
        </x-slot:actions>
    </x-page-header>

    @if (empty($books) || $books->isEmpty())
        <x-empty-state icon="bi bi-check2-circle" icon-class="icon-accent" title="Aucun livre à commander" :wrapped="false">
            Tous les livres ont un stock suffisant. Rien à faire pour le
            moment.
        </x-empty-state>
    @else
        <div class="alert alert-warning d-flex align-items-start" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 mt-1" aria-hidden="true"></i>
            <div>
                {{ $books->total() }}
                {{ $books->total() > 1 ? 'livres sont à recommander' : 'livre est à recommander' }}
                (seuil : {{ $threshold }} en stock ou moins).
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <caption class="visually-hidden">
                    Livres dont le stock est bas ou épuisé
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
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
                            <td class="text-end text-body-secondary">
                                {{ $book->pages }}
                            </td>
                            <td class="text-end">
                                <x-stock-badge :quantity="$book->quantity" />
                            </td>
                            <td class="text-end">
                                <x-action-link :href="route('books.show', $book->id)" icon="bi bi-eye" variant="btn btn-sm btn-outline-secondary">Afficher</x-action-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{--
            Pagination is rendered explicitly rather than with ->links():
            Laravel 13's default paginator emits Tailwind markup, and the
            framework's Bootstrap view emits English copy because the app
            locale is "en" with no lang/ directory.
        --}}
        @if ($books->hasPages())
            <nav
                class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3"
                aria-label="Pagination des livres à commander"
            >
                <p class="small text-body-secondary mb-0">
                    Livres {{ $books->firstItem() }} à {{ $books->lastItem() }}
                    sur {{ $books->total() }}
                </p>
                <ul class="pagination mb-0">
                    <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                        @if ($books->onFirstPage())
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        @else
                            <a
                                class="page-link"
                                href="{{ $books->previousPageUrl() }}"
                                rel="prev"
                                aria-label="Page précédente"
                            >
                                &lsaquo;
                            </a>
                        @endif
                    </li>

                    @foreach ($books->getUrlRange(max(1, $books->currentPage() - 2), min($books->lastPage(), $books->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page === $books->currentPage() ? 'active' : '' }}">
                            @if ($page === $books->currentPage())
                                <span class="page-link" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    <li class="page-item {{ $books->hasMorePages() ? '' : 'disabled' }}">
                        @if ($books->hasMorePages())
                            <a
                                class="page-link"
                                href="{{ $books->nextPageUrl() }}"
                                rel="next"
                                aria-label="Page suivante"
                            >
                                &rsaquo;
                            </a>
                        @else
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        @endif
                    </li>
                </ul>
            </nav>
        @endif
    @endif
@endsection
