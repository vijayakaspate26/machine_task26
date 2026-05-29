<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'is_active', 'price', 'imageName'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
