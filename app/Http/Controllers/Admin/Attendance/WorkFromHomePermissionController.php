<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkFromHomePermission;

class WorkFromHomePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view workFromHomePermission', ['only' => ['index']]);
        $this->middleware('permission:create workFromHomePermission', ['only' => ['create','store']]);
        $this->middleware('permission:update workFromHomePermission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete workFromHomePermission', ['only' => ['destroy']]);
    }
   

    public function index()
    {
        $permissions = WorkFromHomePermission::with('employee')->get();
        return view('admin.attendance.permissions.index', compact('permissions'));
    }

    public function create()
    {
       $employees = Employee::all();
      return view('admin.attendance.permissions.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        WorkFromHomePermission::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.attendance.permissions.store')->with('success', 'Work from home permission created successfully.');
    }

    public function edit(WorkFromHomePermission $permission)
    {
        $employees = Employee::all();
        return view('admin.attendance.permissions.edit',compact('permission', 'employees'));
    }
    

    public function update(Request $request, WorkFromHomePermission $permission)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date|after_or_equal:today',
        ]);
    
        $permission->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
        ]);
    
        return redirect()->route('admin.attendance.permissions.store')->with('success', 'Work from home permission updated successfully.');
    }

    public function destroy(WorkFromHomePermission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.attendance.permissions.store')->with('success', 'Work from home permission deleted successfully.');
    }

}
