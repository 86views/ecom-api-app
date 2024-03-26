<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street',
        'building',
        'area'
    ];



    public function user()
    {
         return $this->belongsToMany(User::class, 'user_id');
    }
}
