<?php

namespace App\Models;

use App\Http\Services\WeatherService;
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

    protected $appends = [
        'weather'
    ];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getWeatherAttribute(){
        $weatherService = new WeatherService($this->id);
        return $weatherService->getSingleCityWeatherData($this->id);
    }
}
