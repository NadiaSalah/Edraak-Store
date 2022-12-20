<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAlert extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'product_id',
        'user_id',
        'alert',
    ];

    public function product(){
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
