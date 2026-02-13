<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// Recipe routes - using Livewire components
Route::get('/recipes', function () {
    return view('pages.recipes-index');
})->name('recipes.index');

Route::get('/recipes/{recipe}', function (\App\Models\Recipe $recipe) {
    return view('pages.recipes-show', ['recipe' => $recipe]);
})->name('recipes.show');

Route::middleware('auth')->group(function () {
    Route::get('/recipes/create/new', function () {
        return view('pages.recipes-create');
    })->name('recipes.create');

    Route::get('/recipes/{recipe}/edit', function (\App\Models\Recipe $recipe) {
        return view('pages.recipes-edit', ['recipe' => $recipe]);
    })->name('recipes.edit');

    Route::get('/my-recipes', function () {
        return view('pages.my-recipes');
    })->name('my-recipes');

    Route::get('/recipe-views', function () {
        return view('pages.recipe-views');
    })->name('recipe-views');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
