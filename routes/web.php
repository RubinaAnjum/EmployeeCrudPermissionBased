<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/user-list',  [UserDetailsController::class, 'list']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user_detail' , [UserDetailsController::class, 'index']);
    Route::get('/user_detail/{id}' , [UserDetailsController::class, 'show']);
    Route::get('/user_detail/search/{UserId}' , [UserDetailsController::class, 'search']);
 
    Route::group(['middleware' => [ 'web', 'role:admin']], function () {
       Route::get('/add-user', function () {
            return view('users.createUser');
        });

        Route::post('/user_detail' , [UserDetailsController::class, 'store']);
        Route::put('/user_detail/{id}' , [UserDetailsController::class, 'update']);
        Route::delete('/user_detail/{id}' , [UserDetailsController::class, 'destroy']);
    });
});

require __DIR__.'/auth.php';
