<?php

use App\Http\Controllers\DoopriseController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/pick-winners', [WelcomeController::class, 'generateDooprizes'])->name('pick.winners');
// grandpize
Route::get('grandprize', [WelcomeController::class, 'grandprize'])->name('grandprize');
Route::post('/pick-grandprize', [WelcomeController::class, 'generateGrandPrize'])->name('pick.grandprize');
// export
Route::get('/export', [WelcomeController::class, 'export'])->name('export');
// export grandprize
Route::get('/export-grandprize', [WelcomeController::class, 'exportGrandprize'])->name('export.grandprize');
Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // dooprize
        Route::get('search-dooprize', [DoopriseController::class,'index'])->name('dooprize.search');
        Route::resource('dooprize', DoopriseController::class);
        // pengguna
        Route::get('search-pengguna', [PenggunaController::class,'index'])->name('pengguna.search');
        Route::resource('pengguna', PenggunaController::class);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
