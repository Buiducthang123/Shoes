<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_colors extends Model
{
    use HasFactory;
    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class, 'product_colors_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_color_size_prices','product_colors_id','size_id')->withPivot('cost');
    }  
    
}
