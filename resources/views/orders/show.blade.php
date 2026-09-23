@extends('layout.app')

@section('title', 'Afficher une commande — Bibliothèque')

@section('content')
    <x-page-header title="Afficher une commande" wrapper-class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 border-bottom pb-3">
        Commande <span class="text-body-tertiary">#{{ $id ?? '—' }}</span>
        <x-slot:actions>
            <x-action-link :href="route('orders.index')" icon="bi bi-arrow-left" variant="btn btn-sm btn-outline-secondary">Retour</x-action-link>
        </x-slot:actions>
    </x-page-header>

    <x-empty-state icon="bi bi-clipboard-x" title="Aucune commande à afficher">
        L'affichage du détail d'une commande n'est pas encore
        implémenté.
        <x-slot:actions>
            <x-action-link :href="route('orders.index')" icon="bi bi-truck">Livres à commander</x-action-link>
        </x-slot:actions>
    </x-empty-state>
@endsection
