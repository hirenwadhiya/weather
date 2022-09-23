<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'latitude',
        'longitude'
    ];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
