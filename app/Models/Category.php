<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


// app/Models/Category.php

public function products()
{
    return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
}


}
