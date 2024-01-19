<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CancellationPolicyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\DrinkTypeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\PenaltyPolicyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Room\RoomTypeController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Room\UlitityRoomController;
use App\Http\Controllers\ServiceController;
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
        //Drink
        Route::match(['get', 'post'], '/drink', [DrinkController::class, 'index'])->name('admin.drink.index');
        Route::match(['get', 'post'], '/drink/trash', [DrinkController::class, 'trash'])->name('admin.drink.trash');
        Route::match(['get'], '/drink/delete/{id}', [DrinkController::class, 'destroy'])->name('admin.drink.delete');
        Route::match(['get', 'post'], '/drink/store', [DrinkController::class, 'store'])->name('admin.drink.store');
        Route::match(['get', 'post'], '/drink/update/{id}', [DrinkController::class, 'update'])->name('admin.drink.update');
        Route::match(['get'], '/drink/restore/{id}', [DrinkController::class, 'restore'])->name('admin.drink.restore');
        Route::match(['get'], '/drink/force/{id}', [DrinkController::class, 'force'])->name('admin.drink.force');
        //RoomType
        Route::match(['get', 'post'], '/roomtype', [RoomTypeController::class, 'index'])->name('admin.roomtype.index');
        Route::match(['get', 'post'], '/roomtype/trash', [RoomTypeController::class, 'trash'])->name('admin.roomtype.trash');
        Route::match(['get'], '/roomtype/delete/{id}', [RoomTypeController::class, 'destroy'])->name('admin.roomtype.delete');
        Route::match(['get', 'post'], '/roomtype/store', [RoomTypeController::class, 'store'])->name('admin.roomtype.store');
        Route::match(['get', 'post'], '/roomtype/update/{id}', [RoomTypeController::class, 'update'])->name('admin.roomtype.update');
        Route::match(['get'], '/roomtype/restore/{id}', [RoomTypeController::class, 'restore'])->name('admin.roomtype.restore');
        Route::match(['get'], '/roomtype/force/{id}', [RoomTypeController::class, 'force'])->name('admin.roomtype.force');
        //UlitityRoom
        Route::match(['get', 'post'], '/ulitityroom', [UlitityRoomController::class, 'index'])->name('admin.ulitityroom.index');
        //Room
        Route::match(['get', 'post'], '/room', [RoomController::class, 'index'])->name('admin.room.index');
        Route::match(['get', 'post'], '/room/trash', [RoomController::class, 'trash'])->name('admin.room.trash');
        Route::match(['get'], '/room/delete/{id}', [RoomController::class, 'destroy'])->name('admin.room.delete');
        Route::match(['get', 'post'], '/room/store', [RoomController::class, 'store'])->name('admin.room.store');
        Route::match(['get', 'post'], '/room/update/{id}', [RoomController::class, 'update'])->name('admin.room.update');
        Route::match(['get'], '/room/restore/{id}', [RoomController::class, 'restore'])->name('admin.room.restore');
        Route::match(['get'], '/room/force/{id}', [RoomController::class, 'force'])->name('admin.room.force');
        //Service
        Route::match(['get', 'post'], '/service', [ServiceController::class, 'index'])->name('admin.service.index');
        Route::match(['get', 'post'], '/service/trash', [ServiceController::class, 'trash'])->name('admin.service.trash');
        Route::match(['get'], '/service/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.service.delete');
        Route::match(['get', 'post'], '/service/store', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::match(['get', 'post'], '/service/update/{id}', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::match(['get'], '/service/restore/{id}', [ServiceController::class, 'restore'])->name('admin.service.restore');
        Route::match(['get'], '/service/force/{id}', [ServiceController::class, 'force'])->name('admin.service.force');
        //CancellationPolicy
        Route::match(['get', 'post'], '/cancellation', [CancellationPolicyController::class, 'index'])->name('admin.cancellation.index');
        Route::match(['get', 'post'], '/cancellation/trash', [CancellationPolicyController::class, 'trash'])->name('admin.cancellation.trash');
        Route::match(['get'], '/cancellation/delete/{id}', [CancellationPolicyController::class, 'destroy'])->name('admin.cancellation.delete');
        Route::match(['get', 'post'], '/cancellation/store', [CancellationPolicyController::class, 'store'])->name('admin.cancellation.store');
        Route::match(['get', 'post'], '/cancellation/update/{id}', [CancellationPolicyController::class, 'update'])->name('admin.cancellation.update');
        Route::match(['get'], '/cancellation/restore/{id}', [CancellationPolicyController::class, 'restore'])->name('admin.cancellation.restore');
        Route::match(['get'], '/cancellation/force/{id}', [CancellationPolicyController::class, 'force'])->name('admin.cancellation.force');
        //PenaltyPolicy
        Route::match(['get', 'post'], '/penalty', [PenaltyPolicyController::class, 'index'])->name('admin.penalty.index');
        Route::match(['get', 'post'], '/penalty/trash', [PenaltyPolicyController::class, 'trash'])->name('admin.penalty.trash');
        Route::match(['get'], '/penalty/delete/{id}', [PenaltyPolicyController::class, 'destroy'])->name('admin.penalty.delete');
        Route::match(['get', 'post'], '/penalty/store', [PenaltyPolicyController::class, 'store'])->name('admin.penalty.store');
        Route::match(['get', 'post'], '/penalty/update/{id}', [PenaltyPolicyController::class, 'update'])->name('admin.penalty.update');
        Route::match(['get'], '/penalty/restore/{id}', [PenaltyPolicyController::class, 'restore'])->name('admin.penalty.restore');
        Route::match(['get'], '/penalty/force/{id}', [PenaltyPolicyController::class, 'force'])->name('admin.penalty.force');
    }
);
