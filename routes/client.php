<?php


use App\Http\Controllers\Auth\Client\AuthController;
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

Route::get('/', function () {
    return view('client.page.main');
});
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('client.login');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('client.register');
Route::match(['get', 'post'], 'forgot', [AuthController::class, 'forgot'])->name('client.forgot');