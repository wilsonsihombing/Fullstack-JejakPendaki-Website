<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'about',
        'VIA',
        'present',
        'award',
        'departure_date',
        'duration',
        'type',
        'price'
    ];  

    protected $hidden = [
        
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'trip_packages_id', 'id');
    }
}
