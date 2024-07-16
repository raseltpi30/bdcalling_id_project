<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;
    protected $table = "smtp";
    protected $fillable = ['mailer','host','port','user_name','password'];
}
