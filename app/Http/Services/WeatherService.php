<?php

namespace App\Http\Services;

use App\Models\City;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private $city;
    private $appId;
    private $forecast5URL;

    public function __construct($city){
        $this->city = $city;
        $this->appId = Config::get('constant.weather.app_key');
        $this->forecast5URL = Config::get('constant.weather.forecast5_url');
    }

    public function getSingleCityWeatherData($city){
        $cityRecord = City::find($city);
        $lat = $cityRecord->latitude;
        $lon = $cityRecord->longitude;

        //make an api call
        try {
            $singleCityApiCall = Http::withHeaders([
                'Accept' => 'application/json'
            ])->get($this->forecast5URL,[
                'lat'   => $lat,
                'lon'   => $lon,
                'exclude'   => '',
                'appid'     => $this->appId
            ]);

            $response = json_decode($singleCityApiCall->body());
            $data = $response->list;
            return $data;
        }catch (\Exception $exception){
            throw new \Exception('Error in fetching weather');
        }
    }
}
