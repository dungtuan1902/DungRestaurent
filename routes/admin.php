<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(
    function () {
        Route::get('/', function () {
            return view('admin.page.dashboard');
        });
    }
);
