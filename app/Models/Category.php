<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'category_name',
        'category_slug',
        'category_icon',
        'homepage',
    ];
    // public function subcategory()
    // {
    //     return $this->hasMany(SubCategory::class);
    // }
    public static function arrayForSelect() {
    	$arr = [];
    	$categories = Category::all();
        foreach ($categories as $category) {
            $arr[$category->id] = $category->category_name;
        } 

        return $arr;
    }
}
