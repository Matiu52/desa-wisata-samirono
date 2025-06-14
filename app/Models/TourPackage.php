<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'package_name', 'description', 'price', 'destination', 'duration', 'itinerary', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listItems()
    {
        return $this->hasMany(ListItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function images()
    {
        return $this->hasMany(TourPackageImage::class);
    }
}
