<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundSetting extends Model
{
    protected $fillable = ['image_path'];

    public function getImageUrlAttribute()
    {
        return asset('images/uploads/' . $this->image_path);
    }
}
