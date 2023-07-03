<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Traits\Synchronize;

class UserController extends Controller
{
    // use Synchronize;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([],404);
        // return UserResource::collection(User::query()->orderBy('id', 'asc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = User::where('id', $id)
                     ->where('status','active')
                     ->select('api_key')
                    ->get();

        if(sizeof($response) == 0){
            $api_key = [["api_key" => null]];
            $response =['status' => 'Not Found', 'api_key' => $api_key];
            return response()->json($response,404);
        }
        else{
            $response =['status' => 'success', 'api_key' => $response];
            return response()->json($response,200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $data = User::findOrFail($id);
        $api_key = bin2hex(random_bytes(32));
        $data->api_key = $api_key;
        $data->update();
        
        //Edit other database on internet as well
        // $this->synchronizeDatabases($api_key,$id);

        $response =['status' => 'success', 'api_key' => $api_key];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = User::where('id', $id)
                     ->where('status','active')
                     ->update(['api_key' => null]);
                     
        if($response) return response()->json([""=>""],204);
    }
}
