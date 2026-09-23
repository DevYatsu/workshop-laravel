<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

// TODO-1-2 Remplacer la route "welcome" par la route "home" affichant le hello world
Route::get('/', [HomeController::class, 'index'])->name('home');

// TODO-7-1 Créer une route pour "order" en s'inspirant de la route "home"
Route::resource('orders', OrderController::class);

// TODO-4-2 Ajouter la ressource BookController aux routes
Route::get('books/order', [BookController::class, 'order'])->name('books.order');
Route::resource('books', BookController::class);
