{{--
    Shared form for creating and editing a book.

    Expected input:
      $action      — form target URL (required)
      $method      — HTTP verb override, e.g. 'PUT' (optional, defaults to POST)
      $book        — existing Book when editing (optional)
      $submitLabel — text on the submit button (optional)
      $cancelRoute — named route for the cancel button (optional)
--}}
{{--     $authors     — collection of Author for the author select (optional) --}}
{{-- --}}
@php
    $book = $book ?? null;
    $authors = $authors ?? [];
    $method = $method ?? null;
    $submitLabel = $submitLabel ?? 'Envoyer';
    $cancelRoute = $cancelRoute ?? 'books.index';
@endphp

<form action="{{ $action }}" method="POST" novalidate>
    @csrf
    @if ($method)
        @method($method)
    @endif

    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 col-12">
                                <strong>Whoops!</strong> Il y a un problème avec vos entrées.<br /><br />
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-12">
                            <label for="inputTitle" class="form-label">
                                Titre
                            </label>
                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                id="inputTitle"
                                value="{{ old('title', $book->title ?? '') }}"
                                required
                            />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="inputPages" class="form-label">
                                Nombre de pages
                            </label>
                            <input
                                type="number"
                                name="pages"
                                class="form-control @error('pages') is-invalid @enderror"
                                id="inputPages"
                                value="{{ old('pages', $book->pages ?? '') }}"
                                min="1"
                                step="1"
                                required
                            />
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="inputQuantity" class="form-label">
                                Quantité
                            </label>
                            <input
                                type="number"
                                name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                id="inputQuantity"
                                value="{{ old('quantity', $book->quantity ?? '') }}"
                                min="0"
                                step="1"
                                required
                            />
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @isset($authors)
                            <div class="col-12 mb-3">
                                <label for="authorSelect" class="form-label">Auteur</label>
                                <select class="form-select @error('author_id') is-invalid @enderror" name="author_id" id="authorSelect">
                                    <option value="">Auteur inconnu...</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endisset
                    </div>
                </div>
                <div class="card-footer d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1" aria-hidden="true"></i>
                        {{ $submitLabel }}
                    </button>
                    <x-action-link :href="route($cancelRoute)" icon="bi bi-arrow-left" variant="btn btn-outline-secondary">Retour</x-action-link>
                </div>
            </div>
        </div>
    </div>
</form>
