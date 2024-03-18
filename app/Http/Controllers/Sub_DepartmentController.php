<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Http\Controllers\Controller;

class Sub_DepartmentController extends Controller
{
    public function index()
    {
        $data = SubDepartment::with('department')->get();
        return view('admin.sub_department.index', compact('data'));
    }
    public function create()
    {
        $departments = Department::all();
        return view('admin.sub_department.create', compact('departments'));
    }
    public function store(request $req)
    {
        $table = new SubDepartment();
        $table->name = $req->name;
        $table->department_id = $req->department_id;
        $table->save();
        return redirect()->route('admin.subdepartment.index');
    }
    public function edit($id)
    {
        $data = SubDepartment::findOrFail($id);
        return view('admin.sub_department.edit', compact('data'));
    }
    public function update(request $req)
    {
        $table = SubDepartment::find($req->id);
        $table->name = $req->name;
        $table->update();
        return redirect()->route('admin.subdepartment.index');
    }

    public function destroy(Request $request)
    {
        $department = SubDepartment::find($request->id);
        $department->delete();
        return redirect()->back();
    }
}
