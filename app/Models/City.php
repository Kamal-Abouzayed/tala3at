<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'city_name_en',
        'city_name_ar'
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function story()
    {
        return $this->hasMany(Story::class);
    }
}
