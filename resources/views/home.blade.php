@extends('layout.app')

@section('title', 'Accueil — Bibliothèque')

@section('content')
    <div class="row align-items-center g-4 g-lg-5 py-lg-4">
        <div class="col-12 col-lg-7">
            <p class="text-uppercase small fw-semibold mb-2 text-accent">
                Atelier Laravel
            </p>
            <h1 class="mb-3">Bibliothèque</h1>
            <p class="lead text-body-secondary mb-4">
                Gérer le catalogue des livres et repérer ceux qu'il faut
                recommander.
            </p>

            <div class="d-flex flex-wrap gap-2">
                <x-action-link :href="route('books.index')" icon="bi bi-journal-text">Voir les livres</x-action-link>
                <x-action-link :href="route('books.create')" icon="bi bi-plus-lg" variant="btn btn-outline-primary">Ajouter un livre</x-action-link>
                <x-action-link :href="route('orders.index')" icon="bi bi-truck" variant="btn btn-outline-secondary">Livres à commander</x-action-link>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-info-circle me-1" aria-hidden="true"></i>
                    Que trouve-t-on ici ?
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex gap-3">
                        <i class="bi bi-journal-text fs-5 icon-accent" aria-hidden="true"></i>
                        <span>
                            <strong>Les livres</strong><br />
                            <span class="text-body-secondary small">
                                Parcourir, ajouter, modifier ou supprimer un
                                livre du catalogue.
                            </span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex gap-3">
                        <i class="bi bi-truck fs-5 icon-accent" aria-hidden="true"></i>
                        <span>
                            <strong>Les commandes</strong><br />
                            <span class="text-body-secondary small">
                                La liste des livres dont le stock est bas ou
                                épuisé.
                            </span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
