<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BestSellingProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Models\BestSellingProducts;
use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', [AuthController::class,"getCurrentUser"]);
//-------------------ĐĂNG NHẬP---------------------------
Route::post('/login',[AuthController::class,'login']);
//-------------------ĐĂNG XUẤT---------------------------
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
//-------------------KIỂM TRA TOKEN----------------------
Route::middleware('auth:sanctum')->get('/check-token', function () {
    return response()->json(['message' => 'Token is valid']);
});
//-------------------ĐĂNG KÝ-------------------------------
Route::post('/register', [AuthController::class,'register']);


//SẢN PHẨM
//-------------------SẢN PHẨM YÊU THÍCH----------------
Route::resource('/favorite', FavoriteProductController::class)->middleware('auth:sanctum');
//------------------SẢN PHẨM BÁN CHẠY-----------------------
Route::get('/bestSelling', [BestSellingProductsController::class,'index']);
//-----------------DANH SÁCH CHI TIẾT SẢN PHẨM
Route::resource('/products',ProductController::class);


//-----------------THƯƠNG HIỆU--------------------------
Route::resource('/category', CategoryController::class);
//-----------------MÀU SẮC------------------------
Route::resource('/colors',ColorController::class);
//-----------------KÍCH CỠ-----------------------
Route::resource('/sizes', SizeController::class);

//GIỞ HÀNG
Route::resource('/cart', CartController::class)->middleware('auth:sanctum');