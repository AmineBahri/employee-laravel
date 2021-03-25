<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function getCountry()
    {
    	$countryModel = Country::get();
    	
    	return response()->json($countryModel);
    }
}
