<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // app/Models/Product.php
public function categories()
{
    return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
}

// app/Models/Product.php

public function images()
{
    return $this->hasMany(Image::class, 'product_id');
}

}
