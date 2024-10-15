<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
    Route::get('/resize/cache/{file_name}', 'AssetController@cache_resize')->where('file_name', '.*');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/empty_orders', function () {
    DB::table('sales_orders')->truncate();
    DB::table('sales_order_products')->truncate();
    DB::table('account_transaction_logs')->truncate();
    DB::table('account_transactions')->truncate();
    DB::table('sale_payments')->truncate();
});

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
Auth::routes();

function create_slug($url)
{
    $path = parse_url($url, PHP_URL_PATH);
    $transformedPath = str_replace('/', '-', trim($path, '/'));
    return $transformedPath;
}

// Route::view('up', "up");
// Route::view('up-image', "up-image");
Route::view('up-image-s3', "up-image-s3");

Route::post('/up-product-image-s3', function () {
    $files = json_decode(file_get_contents(public_path("all_electric_uploadeds.json")));

    $file = $files[request()->si];
    $product_id = explode("/", $file)[8];
    $image_name = explode("/", $file)[9];

    $url = "https://etek-ecom.s3.amazonaws.com/uploads/products/$product_id/$image_name";
    $headers = @get_headers($url);

    if ($headers && strpos($headers[0], '200')) {
    } else {
        $s3_image = Storage::disk('s3')->putFileAs("uploads/products/$product_id", $file, $image_name, 'public');
        // dd($product_id, explode("/", $file));
    }

    return $product_id;
});
