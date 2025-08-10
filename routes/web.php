<?php

use App\Livewire\ArtigoCreate;
use App\Http\Controllers\DashboardController;
use App\Livewire\ArtigoCrud;
use App\Livewire\DesenvolvedorCrud;
use App\Http\Controllers\ArtigoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesenvolvedorController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

  


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::resource('artigos', ArtigoController::class);

    
    Route::get('/artigos/crud', ArtigoCrud::class)->name('artigos.crud');
    Route::get('/desenvolvedores', DesenvolvedorCrud::class)->name('desenvolvedores');

    
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});


Route::get('/', fn () => redirect()->route('login'));
