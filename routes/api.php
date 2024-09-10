<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('admin-login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::group(['prefix' => 'v1'], function () {
    Route::get('/all-product-units', function () {
        $data = DB::table('product_units')
            ->where('title', '!=', null)
            // ->where('product_unit_group_id', 1)
            ->select('title', 'id', 'product_unit_group_id')
            ->orderBy('id', 'asc')
            ->get()
            ->unique('title');
        return response()->json($data, 200);
    });
});
