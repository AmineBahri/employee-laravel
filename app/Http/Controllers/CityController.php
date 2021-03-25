<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CityController extends Controller
{
    public function getCity(Request $request)
    {
    	$state_id = $request->state_id;
    	$cityModel = City::where('state_id', $state_id)->get();
    	//$stateModel = DB::table('city')->where('state_id', $state_id)->get();
    	
    	return response()->json($cityModel);
    }
}
