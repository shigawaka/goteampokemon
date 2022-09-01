<?php

use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\UserPokemonLikedController;
use App\Http\Controllers\UserPokemonHatedController;
use App\Http\Controllers\UserPokemonFavoriteController;
use App\Http\Controllers\UserListController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Profile
Route::get('/profile', function () {
    return Inertia::render('Auth/Profile');
})->middleware(['auth', 'verified'])->name('profile');

Route::post('/profile', [UserProfileController::class, 'store'])
                ->middleware(['auth', 'verified'])
                ->name('updateProfile');
// Other User profile
Route::get('/usersList', [UserListController::class, 'showUsersList'])
                ->middleware(['auth', 'verified'])
                ->name('usersList');
Route::get('/usersListData', [UserListController::class, 'show'])
                ->middleware(['auth', 'verified'])
                ->name('usersListData');
// Get Liked Pokemon
Route::get('/getLikePokemon', [UserPokemonLikedController::class, 'show'])
                ->middleware(['auth', 'verified'])
                ->name('getLikePokemon');
// Insert Like Pokemon
Route::post('/likePokemon', [UserPokemonLikedController::class, 'store'])
                ->middleware(['auth', 'verified'])
                ->name('likePokemon');
// Remove Like Pokemon
Route::delete('/removeLikePokemon', [UserPokemonLikedController::class, 'update'])
                ->middleware(['auth', 'verified'])
                ->name('removeLikePokemon');
// Get Hate Pokemon
Route::get('/getHatePokemon', [UserPokemonHatedController::class, 'show'])
                ->middleware(['auth', 'verified'])
                ->name('getHatePokemon');
// Insert Hate Pokemon
Route::post('/hatePokemon', [UserPokemonHatedController::class, 'store'])
                ->middleware(['auth', 'verified'])
                ->name('hatePokemon');
// Remove Hate Pokemon
Route::delete('/removeHatePokemon', [UserPokemonHatedController::class, 'update'])
                ->middleware(['auth', 'verified'])
                ->name('removeHatePokemon');
// Get Favorite Pokemon
Route::get('/getFavoritePokemon', [UserPokemonFavoriteController::class, 'show'])
                ->middleware(['auth', 'verified'])
                ->name('getFavoritePokemon');
// Insert Favorite Pokemon
Route::post('/favoritePokemon', [UserPokemonFavoriteController::class, 'store'])
                ->middleware(['auth', 'verified'])
                ->name('favoritePokemon');
// Remove Favorite Pokemon
Route::delete('/removeFavoritePokemon', [UserPokemonFavoriteController::class, 'update'])
                ->middleware(['auth', 'verified'])
                ->name('removeFavoritePokemon');


require __DIR__.'/auth.php';
