<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationCollection;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $location = Location::query()->orderBy('id', 'asc')->paginate(10);
    //     return LocationCollection::collection($location);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreLocationRequest $request)
    // {
    //     $data = $request->validated();
    //     $location = Location::create($data);
    //     return response()->json(new LocationCollection($location),201);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $postcode)
    {
        ##'ID','Postcode', commented out
        $location = DB::table('locations')
                        ->select('Street_Address','Lat','Long')
                        ->where('Postcode', '=', $postcode)
                        ->whereNotNull('Postcode')
                        ->get();

        if(sizeof($location) == 0){
            $response =['status' => 'Not Found! Check your postcode and try again', 'locations' => 'Not Found'];
            return response()->json($response,404);
        }
        else{
            $response =['status' => 'success', 'locations' => $location];
            return response()->json($response,200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateLocationRequest $request, Location $location)
    // {
    //     $data = $request->validated();
    //     $location = Location::findOrFail($location);
    //     $location->update($data);
    //     return new LocationCollection($location);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Location $location)
    // {
    //     $location = Location::findOrFail($location);
    //     $location->delete($location);
    //     return response()->json([""=>""],204);
    // }

}
