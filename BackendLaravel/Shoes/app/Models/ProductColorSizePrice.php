<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorSizePrice extends Model
{
    use HasFactory;
    protected $table = 'product_color_size_prices';
    public function carts()
    {
        return $this->belongsToMany(User::class, 'carts','user_id','product_color_size_price_id')->withPivot('quantity');
    }
    
    
}
