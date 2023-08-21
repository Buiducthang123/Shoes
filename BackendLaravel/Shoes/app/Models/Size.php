<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public function productColors()
    {
        return $this->belongsToMany(product_colors::class, 'product_color_size_prices','size_id','product_colors_id');
    }   
}
