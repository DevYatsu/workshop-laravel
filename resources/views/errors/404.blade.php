@extends('layout.app')

@section('title', 'Page introuvable (404) — Bibliothèque')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center py-5 flex-grow-1">
        <div class="w-100">
            <p class="display-1 fw-bold text-center mb-3" aria-hidden="true">404</p>

            <x-empty-state icon="bi bi-compass" title="Page introuvable" icon-class="icon-accent">
                La page que vous cherchez n'existe pas ou a été déplacée.
                <x-slot:actions>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <x-action-link href="{{ route('home') }}" icon="bi bi-house-door">Accueil</x-action-link>
                        <x-action-link
                            href="{{ route('books.index') }}"
                            icon="bi bi-journal-text"
                            variant="btn btn-outline-primary"
                        >Livres</x-action-link>
                    </div>
                </x-slot:actions>
            </x-empty-state>
        </div>
    </div>
@endsection
