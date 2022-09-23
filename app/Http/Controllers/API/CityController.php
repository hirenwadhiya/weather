<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class CityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $cities = City::all();
        return $this->sendResponse(CityResource::collection($cities),__('messages.city.list.success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CityRequest $cityRequest, City $city)
    {
        $input = $cityRequest->all();

        try {
            $newCity = $city->create([
                'name'      => $input['name'],
                'slug'      => SlugService::createSlug(City::class,'slug', $input['name']),
                'latitude'  => $input['latitude'],
                'longitude' => $input['longitude']
            ]);

            return $this->sendResponse(new CityResource($newCity),__('messages.city.create.success'));
        }catch (ModelNotFoundException $exception){
            return $this->sendError(__('messages.city.create.error'),'',400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $city = City::find($id);

        if (!isset($city) || is_null($city)){
            return $this->sendError(__('messages.city.view.error'));
        }
        return $this->sendResponse(new CityResource($city),__('messages.city.view.success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
