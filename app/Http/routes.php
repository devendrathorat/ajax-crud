<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\City;
use Illuminate\Http\Request;
Route::get('/', function () {
    $cities = City::all();

    return View::make('welcome')->with('cities',$cities);
});

Route::get('/cities/{city_id?}',function($city_id){
    $city = City::find($city_id);

    return Response::json($city);
});

Route::post('/cities',function(Request $request){
    $city = City::create($request->all());

    return Response::json($city);
});

Route::put('/cities/{city_id?}',function(Request $request,$city_id){
    $city = City::find($city_id);

    $city->cityname = $request->cityname;
    $city->pincode = $request->pincode;
    $city->cloudcover = $request->cloudcover;
    $city->humidity = $request->humidity;
    $city->temp_C = $request->temp_C;
    $city->visibility = $request->visibility;

    $city->save();

    return Response::json($city);
});

Route::delete('/cities/{city_id?}',function($city_id){
    $city = City::destroy($city_id);

    return Response::json($city);
});
