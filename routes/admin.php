<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
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
        //Admin
        Route::match(['get', 'post'], '/admin', [AdminController::class, 'index'])->name('admin.admin.index');
        Route::match(['get', 'post'], '/admin/trash', [AdminController::class, 'trash'])->name('admin.admin.trash');
        Route::match(['get'], '/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.admin.delete');
        Route::match(['get', 'post'], '/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
        Route::match(['get', 'post'], '/admin/update/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
        Route::match(['get'], '/admin/restore/{id}', [AdminController::class, 'restore'])->name('admin.admin.restore');
        Route::match(['get'], '/admin/force/{id}', [AdminController::class, 'force'])->name('admin.admin.force');
        //Role 
        Route::match(['get', 'post'], '/role', [RoleController::class, 'index'])->name('admin.role.index');
        Route::match(['get', 'post'], '/role/trash', [RoleController::class, 'trash'])->name('admin.role.trash');
        Route::match(['get'], '/role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete');
        Route::match(['get', 'post'], '/role/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::match(['get', 'post'], '/role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::match(['get'], '/role/restore/{id}', [RoleController::class, 'restore'])->name('admin.role.restore');
        Route::match(['get'], '/role/force/{id}', [RoleController::class, 'force'])->name('admin.role.force');
    }
);
