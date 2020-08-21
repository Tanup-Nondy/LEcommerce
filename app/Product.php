<?php

namespace App;

use App\Brand;
use App\Category;
use App\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images(){
    	return $this->hasMany(ProductImage::class);
    }
    public function categories(){
    	return $this->belongsTo(Category::class);
    }
    public function brands(){
    	return $this->belongsTo(Brand::class);
    }
}
