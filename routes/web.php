<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Shared\StatusController;


/*
|--------------------------------------------------------------------------
| Public Routes (Geen auth vereist)
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing'); // Zorg dat de view 'landing.blade.php' bestaat
})->name('landing');

// Authentication Routes (Laravel UI of Breeze)
Auth::routes();

/*
|--------------------------------------------------------------------------
| Beveiligde Routes (auth middleware vereist)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/user', [UserController::class, 'show'])->name('user.profile');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('/user/reservations', [UserController::class, 'reservations'])->name('user.reservations');

    /*
    |--------------------------------------------------------------------------
    | Reservation Routes
    |-----------------------------------------------    ---------------------------
    */

    Route::middleware('auth')->prefix('reserveren')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'list'])->name('list');
        Route::get('/nieuw', [ReservationController::class, 'new'])->name('new');
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
        Route::post('/', [ReservationController::class, 'save'])->name('save');        
        Route::get('/{reservation}/bewerken', [ReservationController::class, 'edit'])->name('edit'); // Edit route
        Route::put('/{reservation}/update', [ReservationController::class, 'update'])->name('update'); // Update route
        Route::delete('/{reservation}/delete', [ReservationController::class, 'delete'])->name('delete');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Role and Permission Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::get('/roles/{roleId}', [RolePermissionController::class, 'show'])->name('roles.show');
    Route::post('/roles', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::post('/roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assignPermissions');
    Route::delete('/roles/{roleId}', [RolePermissionController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{roleId}/users', [RolePermissionController::class, 'usersByRole'])->name('roles.usersByRole');

    /*
    |--------------------------------------------------------------------------
    | Status Management Routes
    |--------------------------------------------------------------------------
    */
    Route::patch('/status/{model}/{id}', [StatusController::class, 'updateStatus'])->name('status.update');
});