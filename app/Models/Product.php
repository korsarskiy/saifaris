<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }



    protected $fillable = [
        'name',
        'description',
        'country',
        'category_id',
        'price',
        'width',
        'length',
        'depth',
        'material',
        '3d_model',
    ];
}
