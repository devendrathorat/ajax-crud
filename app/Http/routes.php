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

Route::get('/cities/weather/{city_name?}', function ($city_name) {
   $loc_array= Array("Satara");     //data validated in foreach.
$api_key="291610860f7e478b90b95310160905";        //should be embedded in your code, so no data validation necessary, otherwise if(strlen($api_key)!=24)
$num_of_days=2;                 //data validated in sprintf

$loc_safe=Array();
foreach($loc_array as $loc){
    $loc_safe[]= urlencode($loc);
}
$loc_string=implode(",", $loc_safe);

//To add more conditions to the query, just lengthen the url string
$basicurl=sprintf('http://api.worldweatheronline.com/free/v1/weather.ashx?key=%s&q=%s&num_of_days=%s&format=json',
    $api_key, $loc_string, intval($num_of_days));



//Premium API
$premiumurl=sprintf('http://api.worldweatheronline.com/premium/v1/weather.ashx?key=%s&q=%s&num_of_days=%s&format=json',
    $api_key, $loc_string, intval($num_of_days));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $premiumurl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
$json_reply =curl_exec($ch);
curl_close($ch);
$json=json_decode($json_reply);
return Response::json($json);
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
