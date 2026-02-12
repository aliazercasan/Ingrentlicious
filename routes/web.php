<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Recipe routes - using Livewire components
Route::get('/recipes', function () {
    return view('components.⚡recipe-index');
})->name('recipes.index');

Route::get('/recipes/{recipe}', function (\App\Models\Recipe $recipe) {
    return view('components.⚡recipe-show', ['recipe' => $recipe]);
})->name('recipes.show');

Route::middleware('auth')->group(function () {
    Route::get('/recipes/create/new', function () {
        return view('components.⚡recipe-create');
    })->name('recipes.create');

    Route::get('/recipes/{recipe}/edit', function (\App\Models\Recipe $recipe) {
        return view('components.⚡recipe-edit', ['recipe' => $recipe]);
    })->name('recipes.edit');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
