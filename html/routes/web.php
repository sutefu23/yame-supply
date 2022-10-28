<?php

    use App\Models\Item;
    use App\Models\UserCategory;
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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',
        [
            "UserCategory"    =>  UserCategory::all(),
            "Items" => Item::with(['wood_species','unit','warehouse'])->get()
        ]
    );
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/BuildInfoList', function () {
    return Inertia::render('BuildInfoList',
        [
            "UserCategory"    =>  UserCategory::all(),
            "Items" => Item::with(['wood_species','unit','warehouse'])->get()
        ]
    );
})->middleware(['auth', 'verified'])->name('BuildInfoList');

require __DIR__.'/auth.php';
