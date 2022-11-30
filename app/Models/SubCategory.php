<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = [
        'name'
    ];

    public function mainCategories()
    {
        return $this->belongsToMany(MainCategory::class, 'main_sub_categories');
    }

    public function mainSubCategories()
    {
        return $this->hasMany(MainSubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            MainSubCategory::class,
            'sub_category_id',
            'main_sub_category_id'
        );
    }
}
