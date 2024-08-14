<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Property extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }
    public function property_size()
    {
        return $this->belongsTo(PropertySize::class, 'property_size_id');
    }
    public function amenity()
    {
        return $this->belongsTo(Amenity::class, 'property_size_id');
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
