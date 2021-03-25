<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function getEmployee(Request $request)
    {
    	$skip = $request->skip;
    	$limit = $request->limit;
    	$employeeModel = DB::table('employee')->skip($skip)->take($limit)->get();
    	$total = Employee::count();
    	//$total = DB::table('employee')->count();
    	$response["employeeModel"] = $employeeModel;
    	$response["total"] = $total;
    	return response()->json($response);
    }

    public function addEmployee(Request $request)
    {
        $file = $request->file('file');
        $uploadPath = "public/image";
        $originalImage = $file->getClientOriginalName();
        $file->move($uploadPath, $originalImage);
        $employeeData = json_decode($request->data, true);
        $employeeData["image"] = $originalImage;
        $employeeModel = Employee::create($employeeData, $request->all());
        Mail::send('welcome', ['employeeModel'=>$employeeData], function($message)
    	{
    		$message->from('mohamedamine.bahri@etudiant-fsegt.utm.tn', 'amine bhar');
    		$message->to('bahrimohamedamin7@gmail.com');
    	});
        return response()->json($employeeModel);
    }

    /*public function addEmployee(Request $request)
    {
        $file = $request->file('file');
        $uploadPath = "public/image";
        $originalImage = $file->getClientOriginalName();
        $file->move($uploadPath, $originalImage);
        $employeeData = json_decode($request->data, true);
        $employeeData["image"] = $originalImage;
        $employeeModel = new Employee();
        $data = $employeeModel->addEmployee($employeeData);
        Mail::send('welcome', ['data'=>$employeeData], function($message)
    	{
    		$message->from('mohamedamine.bahri@etudiant-fsegt.utm.tn', 'amine bhar');
    		$message->to('bahrimohamedamin7@gmail.com');
    	});
    	<!--Registration Successfully completed {{$data['name']}} in welcome.blade.php-->
        //return response()->json($data);
    }*/

    public function deleteEmployee(Request $request)
    {
    	$id = $request->id;
    	$employeeModel = Employee::findOrFail($id);
    	$employeeModel->delete();
    	return response()->json($employeeModel);
    }

    public function updateEmployee(Request $request)
    {
    	$id = $request->id;
    	$employeeModel = Employee::findOrFail($id);
    	$employeeModel->update($request->all());
    	return response()->json($employeeModel);
    }

    public function getOneEmployee(Request $request)
    {
    	$id = $request->id;
    	$employeeModel = Employee::find($id);
    	return response()->json($employeeModel);
    }
}
