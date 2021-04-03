<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $tabel = 'governorates';

    protected $fillable = [
        'governorate_name_en',
        'governorate_name_ar'
    ];

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'governorate_id');
    }

    public function story()
    {
        return $this->hasMany(Story::class);
    }
}
