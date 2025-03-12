<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $fillable = ['tour_package_id', 'name'];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}