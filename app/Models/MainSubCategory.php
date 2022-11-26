<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainSubCategory extends Model
{
    use HasFactory;
    
 
    
    protected $fillable = [
        'main_category_id',
        'sub_category_id'
    ];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    
}
