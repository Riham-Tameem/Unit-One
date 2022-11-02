<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::get();
        return view('employee.index')->with(['employees'=>$employees]);
    }
}
