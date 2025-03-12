<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'name',
        'email',
        'phone',
        'notes',
    ];

    // Relasi ke package
    public function package()
    {
        return $this->belongsTo(TourPackage::class);
    }
}