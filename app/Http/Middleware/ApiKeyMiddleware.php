<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'api_key' => 'required|string'
        ]);

        #Check if empty params and get postcode for validation
        $params = $request->route()->parameters();
        function getPostcode($params){
            if(sizeof($params) == 0){
                $postcode = false;
                return $postcode;
            }else{
                 #Map postcode
                $object = (object) $params;
                $postcode = $object->postcode;
                return $postcode;
            }
        }

        if (getPostcode($params) && $validator->fails())
        {
           $errors = implode(" ", $validator->errors()->all());
           $response =['status' => $errors, 'locations' => 'Not yet processed'];
           return response()->json($response,400);
        }
        elseif(! getPostcode($params) && ! $validator->fails()){
            $response =['status' => 'postcode field is required', 'locations' => 'Not yet processed'];
            return response()->json($response,400);
        }
        elseif(! getPostcode($params) && $validator->fails()){
           $response =['status' => 'all fields are required', 'locations' => 'Not yet processed'];
           return response()->json($response,400);
        }
        else
        {
            $api_key = $request->input('api_key');

            $location = DB::table('users')
                    ->select('api_key')
                    ->where('api_key', '=', $api_key)
                    ->where('status', '=', 'active')
                    ->whereNotNull('api_key')
                    ->get();

            if(sizeof($location) == 0){
                $response = ['status'=>'Access denied! Please provide a valid api key', 'locations' => 'Empty'];
                return response()->json($response,401);
            }
            else{
                return $next($request);
            }
        }
    }
}
