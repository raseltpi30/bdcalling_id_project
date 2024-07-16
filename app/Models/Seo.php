<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_tag',
        'meta_author',
        'meta_description',
        'meta_keyword',
        'google_verification',
        'google_analytics',
        'alexa_verification',
    ];
}
