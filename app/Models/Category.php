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
    ];
    // public function subcategory()
    // {
    //     return $this->hasMany(SubCategory::class);
    // }

    public function property()
    {
        return $this->hasMany(Property::class);
    }
}
