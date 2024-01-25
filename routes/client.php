<?php


use App\Http\Controllers\Auth\Client\AuthController;
use App\Http\Controllers\Client\ClientController;
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

// Route::get('/', function () {
//     return view('client.page.main');
// });
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('client.login');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('client.register');
Route::match(['get', 'post'], 'forgot', [AuthController::class, 'forgot'])->name('client.forgot');
Route::match(['get', 'post'], '/', [ClientController::class, 'main'])->name('client.main');

Route::middleware(['CheckUser'])->group(function () {
    Route::match(['get', 'post'], '/profile', [ClientController::class, 'profile'])->name('client.profile');
    Route::match(['get', 'post'], '/update_profile', [ClientController::class, 'update_profile'])->name('client.update_profile');
});
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('client.logout');
