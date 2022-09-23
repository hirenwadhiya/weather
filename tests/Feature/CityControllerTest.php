<?php

namespace Tests\Feature;

use App\Http\Services\WeatherService;
use App\Models\City;
use Faker\Provider\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIndexReturnsDataInvalidFormat(){
        $this->json('get',route('city.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'latitude',
                        'longitude',
                        'weather'
                    ]
                ]
            ]);
    }

    public function testCityCreatedSuccessfully(){
        $payload = [
            'name'      => Address::citySuffix(),
            'latitude'  => Address::latitude(),
            'longitude' => Address::longitude()
        ];

        $this->json('post',route('city.store', $payload))
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'latitude',
                    'longitude',
                    'weather'
                ]
            ]);
        $this->assertDatabaseHas('cities',$payload);
    }

    public function testCityIsShownCorrectly(){
        $city = City::create([
            'name'      => Address::citySuffix(),
            'latitude'  => Address::latitude(),
            'longitude' => Address::longitude()
        ]);

        $this->json('get',route('city.show',[$city->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'latitude',
                    'longitude',
                    'weather'
                ]
            ]);
    }
}
