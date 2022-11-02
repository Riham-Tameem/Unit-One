<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateRequest;
use App\Http\Resources\EmployeeResource;
use App\Jobs\EventSend;
use App\Mail\TestMail;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends BaseController
{
    public function index()
    {
        $employees = Employee::get();
        return $this->sendResponse('all categories', EmployeeResource::collection($employees));
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        $employee = Employee::create([
            'name' => $data['name'],
            'date_of_registration' => $data['date_of_registration'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
        $employee->save($data);
        $details=[
            'title' => 'from Unit-One',
            'message' => 'Hello  mail system'
        ];
        Mail::to($data['email'])->send(new TestMail($details));

        return $this->sendResponse('add employee successfully', new EmployeeResource($employee));

    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $employee = Employee::find($data['id']);
        if ($employee) {
            $employee->delete();
            return $this->sendResponse('delete employee successfully ', []);
        } else {
            return $this->sendError('enter valid id ');
        }

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $employee = Employee::find($id);
        if (!$employee) {
            return $this->sendError(404, 'There is no employee has this id');
        } else {
            $employee->update($data);
            return $this->sendResponse('employee updated success', new EmployeeResource($employee),);

        }
    }
}
