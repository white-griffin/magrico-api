<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded =['id'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
