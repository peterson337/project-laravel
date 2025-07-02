<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinancesController;
use App\Http\Controllers\RecoverFinanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/finances', [FinancesController::class, 'saveFinances'] )->middleware('auth', 'verified') ->name('finances');
Route::get('/finances-recover', [FinancesController::class, 'index'] )->middleware('auth', 'verified') ->name('finances-recover');
Route::delete('/delete-finance/{id}', [FinancesController::class, 'deleteFinance'] )->middleware('auth', 'verified') ->name('delete-finance');
Route::put('/edit-finance/{id}', [FinancesController::class, 'editFinance'] )->middleware('auth', 'verified') ->name('edit-finance');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
