@extends('layout.app')

@section('title', 'Modifier une commande — Bibliothèque')

@section('content')
    <x-page-header title="Modifier une commande">
        La modification d'une commande n'est pas encore implémentée.
    </x-page-header>

    <x-empty-state icon="bi bi-clipboard-x" title="Formulaire indisponible">
        Cette page ne contient pas encore de formulaire.
        <x-slot:actions>
            <x-action-link :href="route('orders.index')" icon="bi bi-arrow-left">Livres à commander</x-action-link>
        </x-slot:actions>
    </x-empty-state>
@endsection
