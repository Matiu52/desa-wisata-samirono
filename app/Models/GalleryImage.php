<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_id',
        'image_path',
        'public_id',
        'caption',
    ];
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
