<?php
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


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


// Register/Login to the application on the web to get an Access Token (using Sanctum authentication) to be able to access the Image Manipulation API:
Route::get('/', function () {
    return view('welcome');
});

// Register/Login to the application on the web to get an Access Token (using Sanctum authentication) to be able to access the Image Manipulation API:
Route::middleware('auth')->group(function() { // Using 'auth' middleware for authentication
    Route::get( '/dashboard',            [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get( '/token/create',         [DashboardController::class, 'showTokenForm'])->name('token.showForm');
    Route::post('/token/create',         [DashboardController::class, 'createToken'])->name('token.create');
    Route::post('/token/delete/{token}', [DashboardController::class, 'deleteToken'])->name('token.delete');
});


require __DIR__.'/auth.php';