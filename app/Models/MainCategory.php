<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'main_categories';

    protected $fillable = [
        'name',
        'image'

    ];

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'main_sub_categories');
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
            'main_category_id',
            'main_sub_category_id'
        );
    }
}
