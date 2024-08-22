<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

use App\Models\Employee;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class indexController extends Controller
{
    // public function index()
    // {
    //     $data['Employees'] = Employee::get();

    //     $data['Position'] = Position::get();

    //     $data['departments'] = Department::all();

    //     return view('admin.employee.index', $data);
    // }

    public function index(){
        
        return view('employee.dashboard');
    }
    public  function login(){
        return view('employee.login');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if(Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
            Auth::logout();
            return  Redirect()->route('employee.attendance.index');
          
        } else {
            return redirect()->route('employee.login')->with('error' ,'Invalid Email Or Password');
        }
    }
    
    // public function store(Request  $request)
    // {
    //     // return $request;
    //     $rules = [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:employees',
    //         'phone' => 'required|numeric|unique:employees',
    //         'password' => 'required',
    //         'department_id' => 'required',
    //         'sub_department_id' => 'required',
    //         'position_id' => 'required',
    //     ];
      

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->passes()) {
    //         $employee = new Employee();
    //         $employee->name = $request->name;
    //         $employee->email = $request->email;
    //         $employee->phone = $request->phone;
    //         $employee->department_id = $request->department_id;
    //         $employee->sub_department_id = $request->sub_department_id;
    //         $employee->position_id = $request->position_id;
    //         $employee->password = Hash::make($request->password);
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('uploads/profile_pic/'), $imageName);
    //             $employee->pic = 'uploads/profile_pic/'.$imageName;
    //         } 

    //         $employee->save();
    //         return response()->json([
    //             'status' => true,
    //             'message' => "Employee created Successfully"
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }
    // public function create()
    // {

    //     $data['Position'] = Position::get();


    //     $data['departments'] = Department::all();



    //     return view('admin.employee.create', $data);
    // }

    public function subCategory(Request $req)
    {
        $subCategory = SubDepartment::where('department_id', $req->category_id)->get();
        if (!empty($subCategory)) {
            return response()->json([
                'status' => true,
                'subCategories' => $subCategory
            ]);
        } else {
            return response()->json([
                'status' => false,
                'subCategories' => []
            ]);
        }
    }
    // public function edit($id){
    //     $data["employee"]  = Employee::findOrFail($id);
    //     $data['departments'] = Department::all();
    //     $data['sub_departments_id'] = SubDepartment::all();
    //     $data['position'] = Position::all();
    //     // return  $data['positions '];
    //     return view('admin.employee.edit',$data);
    // }

    // public function update(Request  $request)
    // {
    //     $rules = [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required|numeric',
           
    //         'department_id' => 'required',
    //         'sub_department_id' => 'required',
    //         'position_id' => 'required',
    //     ];
      

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->passes()) {
    //         $employee = Employee::findOrFail($request->id);
    //         $employee->name = $request->name;
    //         $employee->email = $request->email;
    //         $employee->phone = $request->phone;
    //         $employee->department_id = $request->department_id;
    //         $employee->sub_department_id = $request->sub_department_id;
    //         $employee->position_id = $request->position_id;
    //         $employee->password = Hash::make($request->password);
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('uploads/profile_pic/'), $imageName);
    //             $employee->pic = 'uploads/profile_pic/'.$imageName;
    //         } 

    //         $employee->update();
    //         return redirect()->back();
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }

    // public function destory($id){
    //     $department = Employee::findOrFail($id);
    //     $department->delete();
    //     return redirect()->back();  
    // }
    public function logout()
    {
        Auth::guard('employee')->logout();

        return redirect()->route('employee.login'); // Redirect to the desired page after logout
    }
}
