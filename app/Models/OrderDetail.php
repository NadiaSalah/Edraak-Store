<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'order_id',
        'product_size_id',
        'quantity',
        'price',
        'total_price',
        'status',
        
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function productSize(){
        return $this->belongsTo(ProductSizeItem::class);
    }
}
