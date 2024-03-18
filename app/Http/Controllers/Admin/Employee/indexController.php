<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Schedule;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class indexController extends Controller
{
    public function index()
    {
        $data['Employees'] = Employee::get();

        $data['Position'] = Position::get();
        $data['schedules'] =  Schedule::get();

        $data['departments'] = Department::all();

        return view('admin.employee.index', $data);
    }
    public function store(Request  $request)
    {
        // return $request;
        $rules = [
            'name' => 'required',
            'schedule_id' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|numeric|unique:employees',
            'password' => 'required',
            'department_id' => 'required',
            'joining_date' => 'required|date',
            'position_id' => 'required',
        ];
      

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->schedule_id = $request->schedule_id;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->joining_date = $request->joining_date; 
            $employee->department_id = $request->department_id;
            $employee->sub_department_id = $request->sub_department_id;
            $employee->position_id = $request->position_id;
            $employee->password = Hash::make($request->password);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profile_pic/'), $imageName);
                $employee->pic = 'uploads/profile_pic/'.$imageName;
            } 

            $employee->save();
            return response()->json([
                'status' => true,
                'message' => "Employee created Successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function create()
    {
        $data['Position'] = Position::get();
        $data['departments'] = Department::all();
        return view('admin.employee.create', $data);
    }
    public function edit($id){
        $data["employee"]  = Employee::findOrFail($id);
        $data['departments'] = Department::all();
        $data['positions'] = Position::all();
        $data['schedules'] = Schedule::all();
        
        // Get the selected employee's department
        $selectedDepartmentId = $data["employee"]->department_id;
        
        // Get sub-departments related to the selected department
        $data['sub_departments'] = SubDepartment::where('department_id', $selectedDepartmentId)->get();
        
        return view('admin.employee.edit', $data);
    }
    
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'schedule_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'department_id' => 'required',
            'joining_date' => 'required|date',
            'position_id' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->passes()) {
            $employee = Employee::findOrFail($request->id);
            $employee->name = $request->name;
            $employee->schedule_id = $request->schedule_id;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->joining_date = $request->joining_date; 
            $employee->department_id = $request->department_id;
            $employee->sub_department_id = $request->sub_department_id;
            $employee->position_id = $request->position_id;
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profile_pic/'), $imageName);
                $employee->pic = 'uploads/profile_pic/'.$imageName;
            } 
    
            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }
    
            $employee->update();
            return redirect()->back();
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function destory($id){
        $department = Employee::findOrFail($id);
        $department->delete();
        return redirect()->back();  
    }

}
