<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class StateController extends Controller
{
    public function getState(Request $request)
    {
    	$country_id = $request->country_id;
    	$stateModel = State::where('country_id', $country_id)->get();
    	//$stateModel = DB::table('state')->where('country_id', $country_id)->get();
    	
    	return response()->json($stateModel);
    }
}
