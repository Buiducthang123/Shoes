<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductColorSizePrice;
use App\Models\product_colors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = $user->carts;
        
        return response()->json([
            "productsCart" => $products
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
        try {
            $product_id = $request->product_id;
            $color_id = $request->color_id;
            $size_id = $request->size_id;
            $user_id = Auth::id();
            $quantity = $request->quantity_buy;

            // Tìm thông tin product_color dựa trên product_id và color_id
            $product_color = product_colors::where('product_id', $product_id)->where('color_id', $color_id)->first();

            if ($product_color) {
                $product_color_id = $product_color->id;
                // Tìm thông tin product_color_size_price dựa trên product_color_id và size_id
                $product_color_size_price = ProductColorSizePrice::where('product_colors_id', $product_color_id)->where('size_id', $size_id)->first();

                if ($product_color_size_price) {
                    $product_color_size_price_id = $product_color_size_price->id;
                    $existingCart = Cart::where('user_id', $user_id)->where('product_color_size_price_id', $product_color_size_price->id)->first();
                    if ($existingCart) {
                        return response()->json([
                            "message" => "Sản phẩm đã tồn tại trong giỏ hàng. Số lượng không được cập nhật."
                        ], 200);
                    }
                    // Tạo và lưu dữ liệu vào bảng carts
                    $cart = new Cart;
                    $cart->user_id = $user_id;
                    $cart->product_color_size_price_id = $product_color_size_price_id;
                    $cart->quantity = $quantity;
                    $cart->save();

                    return response()->json([
                        "message" => "Thêm vào giỏ hàng thành công."
                    ], 200);
                } else {
                    return response()->json(["message" => "Không tìm thấy thông tin về sản phẩm."], 404);
                }
            } else {
                return response()->json(["message" => "Không tìm thấy thông tin về sản phẩm."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(["message" => "Có lỗi xảy ra."], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;
        
        $cart = Cart::where('product_color_size_price_id',$id)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cart->quantity = $quantity;
        $cart->save();

        return response()->json(['message' => 'Cart item updated successfully', 'cart' => $cart], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::where('product_color_size_price_id',$id)->first();
       
        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Xóa thành công'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm '], 404);
        }
    }
    
}