<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    
    protected $fillable = ['name', 'age', 'salary', 'hobby', 'country', 'state', 'city', 'image'];

    public function addEmployee($data)
    {
    	DB::table('employee')->insert($data);
    }
}
