<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = [
        'section',
        'title',
        'content',
        'images',
    ];
}