<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webreview extends Model
{
    use HasFactory;
    protected $table = 'webreviews';
    protected $fillable = [
        'user_id',
        'name',
        'review',
        'rating',
        'review_date',
    ];
}
