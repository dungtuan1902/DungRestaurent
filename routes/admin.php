<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DrinkTypeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodTypeController;
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
        //FoodType
        Route::match(['get', 'post'], '/foodtype', [FoodTypeController::class, 'index'])->name('admin.foodtype.index');
        Route::match(['get', 'post'], '/foodtype/trash', [FoodTypeController::class, 'trash'])->name('admin.foodtype.trash');
        Route::match(['get'], '/foodtype/delete/{id}', [FoodTypeController::class, 'destroy'])->name('admin.foodtype.delete');
        Route::match(['get', 'post'], '/foodtype/store', [FoodTypeController::class, 'store'])->name('admin.foodtype.store');
        Route::match(['get', 'post'], '/foodtype/update/{id}', [FoodTypeController::class, 'update'])->name('admin.foodtype.update');
        Route::match(['get'], '/foodtype/restore/{id}', [FoodTypeController::class, 'restore'])->name('admin.foodtype.restore');
        Route::match(['get'], '/foodtype/force/{id}', [FoodTypeController::class, 'force'])->name('admin.foodtype.force');
        //Food
        Route::match(['get', 'post'], '/food', [FoodController::class, 'index'])->name('admin.food.index');
        Route::match(['get', 'post'], '/food/trash', [FoodController::class, 'trash'])->name('admin.food.trash');
        Route::match(['get'], '/food/delete/{id}', [FoodController::class, 'destroy'])->name('admin.food.delete');
        Route::match(['get', 'post'], '/food/store', [FoodController::class, 'store'])->name('admin.food.store');
        Route::match(['get', 'post'], '/food/update/{id}', [FoodController::class, 'update'])->name('admin.food.update');
        Route::match(['get'], '/food/restore/{id}', [FoodController::class, 'restore'])->name('admin.food.restore');
        Route::match(['get'], '/food/force/{id}', [FoodController::class, 'force'])->name('admin.food.force');
        //DrinkType
        Route::match(['get', 'post'], '/drinktype', [DrinkTypeController::class, 'index'])->name('admin.drinktype.index');
        Route::match(['get', 'post'], '/drinktype/trash', [DrinkTypeController::class, 'trash'])->name('admin.drinktype.trash');
        Route::match(['get'], '/drinktype/delete/{id}', [DrinkTypeController::class, 'destroy'])->name('admin.drinktype.delete');
        Route::match(['get', 'post'], '/drinktype/store', [DrinkTypeController::class, 'store'])->name('admin.drinktype.store');
        Route::match(['get', 'post'], '/drinktype/update/{id}', [DrinkTypeController::class, 'update'])->name('admin.drinktype.update');
        Route::match(['get'], '/drinktype/restore/{id}', [DrinkTypeController::class, 'restore'])->name('admin.drinktype.restore');
        Route::match(['get'], '/drinktype/force/{id}', [DrinkTypeController::class, 'force'])->name('admin.drinktype.force');
    }
);
