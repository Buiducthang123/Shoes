<?php

namespace App\Http\Controllers;

use App\Models\BestSellingProducts;
use Illuminate\Http\Request;

class BestSellingProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Lấy ra 4 sản phẩm bán chạy nhất
        
        $bestSelling = BestSellingProducts::orderBy('sales_quantity', 'desc')->limit(4)->get();
        $products = $bestSelling->map(function ($item) {
            return $item->product->load(['category','productColors.thumbnails']);
        });
        if ($products) {
            return response()->json([
                'bestSelling' => $products
            ], 200);
        }
       
        
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
    }

    /**
     * Display the specified resource.
     */
    public function show(BestSellingProducts $bestSellingProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BestSellingProducts $bestSellingProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BestSellingProducts $bestSellingProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BestSellingProducts $bestSellingProducts)
    {
        //
    }
}
