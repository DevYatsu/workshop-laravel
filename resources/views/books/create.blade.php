@extends('layout.app')

@section('title', 'Nouveau livre — Bibliothèque')

@section('content')
    <x-page-header title="Nouveau livre" :centered="true">
        Renseignez le titre, le nombre de pages et la quantité en
        stock.
    </x-page-header>

    @include('books._form', [
        'action' => route('books.store'),
        'submitLabel' => 'Envoyer',
    ])
@endsection
