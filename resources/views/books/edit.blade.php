@extends('layout.app')

@section('title', 'Modifier un livre — Bibliothèque')

@section('content')
    <x-page-header title="Modifier un livre" :centered="true">
        {{ $book->title }} <span class="text-body-tertiary">#{{ $book->id }}</span>
    </x-page-header>

    @include('books._form', [
        'action' => route('books.update', $book->id),
        'method' => 'PUT',
        'book' => $book,
        'submitLabel' => 'Modifier',
    ])
@endsection
