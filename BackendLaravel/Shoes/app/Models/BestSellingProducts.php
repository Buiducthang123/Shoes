<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSellingProducts extends Model
{
    use HasFactory;
    // Trong mô hình BestSellingProducts
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}