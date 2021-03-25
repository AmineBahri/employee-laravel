<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;

class UserController extends Controller
{
    public function register(Request $request)
    {
    	$request['password'] = Hash::make($request->password);
    	$email = $request->email;
    	$Userdata = User::where('email', $email)->get();
    	if(count($Userdata) == 0)
    	{
    		$data = User::create($request->all());
    	    $response['message'] = 'User Registration Successfully';
    	    $response['data'] = $request->all();
    	    $response['status'] = 1;
    	}else
    	  {
    	  	$response['status'] = 0;
    	  	$response['message'] = 'Email already exists';
    	  }
    	
        return response()->json($response);
    }

    public function login(Request $request)
    {
    	//$userModel = new User();
    	$email = $request->email;
    	$password = $request->password;
    	//$Userdata = $userModel->login($email, $password);
    	$userdata = User::where('email', $email)->get()->first();
    	$result = Hash::check($password, $userdata->password);
    	if ($userdata && $result) //(($Userdata->email == $email) && $result)
    	{
    		$payload = [
                'username' => $userdata->name
            ];
            $token = JWTAuth::fromUser($userdata,$payload);
    	    $response['token'] = $token;
    	    $response['status'] = 1;
    	    $response['message'] = 'Login Successfully';
    	}
    	else
    	{
    		$response['status'] = 0;
    	  	$response['message'] = 'Email or Password is wrong';
    	}
    	
        return response()->json($response);
    }
}
