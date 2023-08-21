<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $foreignKey = "category_id";
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function thumbnails()
    {
        return $this->hasMany(Thumbnail::class, 'product_id');
    }
    function best_selling_product()
    {
        return $this->hasOne(BestSellingProducts::class);
    }
    public function colors()
    {
        return $this->hasMany(product_colors::class, 'product_id');
    }
    public function productColors()
    {
        return $this->hasMany(product_colors::class, 'product_id');
    }
    public function favoriteProducts()
    {
        return $this->belongsToMany(User::class, 'favorite_products', 'user_id', 'product_id');
    }
    


}