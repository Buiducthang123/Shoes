<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        // $favoriteProducts = $user->favoriteProducts;
        $favoriteProducts = $user->favoriteProducts()->with('category')->get();

        return response()->json([
            "favorite_products" => $favoriteProducts,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);
        $existingFavorite = FavoriteProduct::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                "message" => "Sản phẩm đã được thêm vào danh sách yêu thích trước đó"
            ], 422);
        }

        $favoriteProducts = new FavoriteProduct();
        $favoriteProducts->fill($request->all());
        $favoriteProducts->save();
        return response()->json([
            "message" => "Tuyệt quá bạn vừa thêm thành công một sản phẩm",
            "product_id" => $product_id,
            "user_id" => $user_id
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(FavoriteProduct $favoriteProduct)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavoriteProduct $favoriteProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavoriteProduct $favoriteProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FavoriteProduct $favoriteProduct, $id)
    {
        $favoriteProduct = FavoriteProduct::where('product_id', $id)->first();

        if ($favoriteProduct) {
            $favoriteProduct->delete();
            return response()->json(['message' => 'Xóa sản phẩm yêu thích thành công'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm yêu thích'], 404);
        }
    }

}