@extends('layout.app')

@section('title', 'Commandes — Bibliothèque')

@section('content')
    <x-page-header title="Commandes">
        Le suivi des commandes n'est pas encore implémenté.
    </x-page-header>

    <x-empty-state icon="bi bi-clipboard-x" title="Aucune commande">
        Cette page est une ébauche. La liste des livres à
        commander reste disponible.
        <x-slot:actions>
            <x-action-link :href="route('orders.index')" icon="bi bi-truck">Livres à commander</x-action-link>
        </x-slot:actions>
    </x-empty-state>
@endsection
