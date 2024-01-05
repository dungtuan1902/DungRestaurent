<?php
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(
    function () {
        Route::get('/', function () {
            return view('admin.page.dashboard');
        })->name('dashboard');
        //Department 
        Route::match(['get', 'post'], '/department', [DepartmentController::class, 'index'])->name('admin.department.index');
        Route::match(['get', 'post'], '/department/trash', [DepartmentController::class, 'trash'])->name('admin.department.trash');
        Route::match(['get'], '/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('admin.department.delete');
        Route::match(['get', 'post'], '/department/store', [DepartmentController::class, 'store'])->name('admin.department.store');
        Route::match(['get', 'post'], '/department/update/{id}', [DepartmentController::class, 'update'])->name('admin.department.update');
        Route::match(['get'], '/department/restore/{id}', [DepartmentController::class, 'restore'])->name('admin.department.restore');
        Route::match(['get'], '/department/force/{id}', [DepartmentController::class, 'force'])->name('admin.department.force');
    }
);
