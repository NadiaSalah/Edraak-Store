<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSizeItem extends Model
{
    use HasFactory;
    use SoftDeletes;
   

    protected $fillable =[
        'product_id',
        'size_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function size(){
        return $this->belongsTo(size::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
