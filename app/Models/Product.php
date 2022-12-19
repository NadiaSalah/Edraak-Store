<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'image',
        'quantity',
        'price',
        'discount',
        'view',
        'return',
        'main_sub_category_id',
        'created_at'
    ];

    public function MainSubCategory()
    {
        return $this->belongsTo(MainSubCategory::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size_items');
    }

    public function productAlerts()
    {
        return $this->hasMany(ProductAlert::class);
    }
    public function productSizeItems()
    {
        return $this->hasMany(ProductSizeItem::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
