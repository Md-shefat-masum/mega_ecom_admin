<?php

use App\Modules\UserManagement\User\Controllers\CustomerController;
use App\Modules\UserManagement\User\Controllers\EmployeeController;
use App\Modules\UserManagement\User\Controllers\RetailerController;
use App\Modules\UserManagement\User\Controllers\SupplierController;
use App\Modules\UserManagement\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('store', [UserController::class, 'store']);
        Route::post('update/{id}', [UserController::class, 'update']);
        Route::post('soft-delete', [UserController::class, 'softDelete']);
        Route::post('destroy', [UserController::class, 'destroy']);
        Route::post('restore', [UserController::class, 'restore']);
        Route::post('import', [UserController::class, 'import']);
        Route::post('bulk-actions', [UserController::class, 'bulkAction']);
        Route::get('/{slug}', [UserController::class, 'show']);
    });

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('{slug}', [CustomerController::class, 'show']);
        Route::post('store', [CustomerController::class, 'store']);
        Route::post('update/{id}', [CustomerController::class, 'update']);
        Route::post('soft-delete', [CustomerController::class, 'softDelete']);
        Route::post('destroy', [CustomerController::class, 'destroy']);
        Route::post('restore', [CustomerController::class, 'restore']);
        Route::post('import', [CustomerController::class, 'import']);
        Route::post('bulk-actions', [CustomerController::class, 'bulkAction']);

        Route::post('account-info-update', [CustomerController::class, 'AccountInfoUpdate']);
        Route::post('address-info-update', [CustomerController::class, 'AddressInfoUpdate']);
        Route::post('update-profile-picture', [CustomerController::class, 'UpdateProfilePicture']);
        Route::post('change-password', [CustomerController::class, 'ChangePassword']);
    });

    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('store', [SupplierController::class, 'store']);
        Route::post('update/{id}', [SupplierController::class, 'update']);
        Route::post('soft-delete', [SupplierController::class, 'softDelete']);
        Route::post('destroy', [SupplierController::class, 'destroy']);
        Route::post('restore', [SupplierController::class, 'restore']);
        Route::post('import', [SupplierController::class, 'import']);
        Route::post('bulk-actions', [SupplierController::class, 'bulkAction']);
        Route::get('/{slug}', [SupplierController::class, 'show']);
    });

    Route::prefix('retailers')->group(function () {
        Route::get('/', [RetailerController::class, 'index']);
        Route::post('store', [RetailerController::class, 'store']);
        Route::post('update/{id}', [RetailerController::class, 'update']);
        Route::post('soft-delete', [RetailerController::class, 'softDelete']);
        Route::post('destroy', [RetailerController::class, 'destroy']);
        Route::post('restore', [RetailerController::class, 'restore']);
        Route::post('import', [RetailerController::class, 'import']);
        Route::post('bulk-actions', [RetailerController::class, 'bulkAction']);
        Route::get('{slug}', [RetailerController::class, 'show']);
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('store', [EmployeeController::class, 'store']);
        Route::post('update/{id}', [EmployeeController::class, 'update']);
        Route::post('soft-delete', [EmployeeController::class, 'softDelete']);
        Route::post('destroy', [EmployeeController::class, 'destroy']);
        Route::post('restore', [EmployeeController::class, 'restore']);
        Route::post('import', [EmployeeController::class, 'import']);
        Route::post('bulk-actions', [EmployeeController::class, 'bulkAction']);
        Route::get('{slug}', [EmployeeController::class, 'show']);
    });
});
