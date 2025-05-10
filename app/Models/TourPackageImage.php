<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackageImage extends Model
{
    protected $fillable = ['tour_package_id', 'image_path'];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
