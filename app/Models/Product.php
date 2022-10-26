<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $guarded = [];

    function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
