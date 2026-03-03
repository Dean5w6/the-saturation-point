<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;  

class Product extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'description',
        'price',
        'stock',
        'img_path',
    ];
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
 
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'brand' => $this->brand,
            'description' => $this->description,
        ];
    }

    public function reviews() { return $this->hasMany(Review::class)->latest(); }
}