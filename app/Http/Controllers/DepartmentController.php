<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view deparment', ['only' => ['index']]);
        $this->middleware('permission:create deparment', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update deparment', ['only' => ['update','edit']]);
        $this->middleware('permission:delete deparment', ['only' => ['destroy']]);
    }


    public function index(){
        $data = Department::all();
        return view('admin.department.index',compact('data'));
    }
    public function create(){
        return view('admin.department.create');
    }
    public function edit($id){
        $data = Department::find($id);
        return view('admin.department.edit',compact('data'));
    }
    
    public function store(request $req){
        $table = new Department();
        $table->name = $req->name;
        $table->save();
        return redirect()->route('admin.department.index');
    }
    public function update(request $req){
        $table = Department::find($req->id);
        $table->name = $req->name;
        $table->update();
        return redirect()->route('admin.department.index');
    }

    public function destory(Request $request){
        $department = Department::find($request->id);
        $department->delete();
        return redirect()->back();
    }
   
}
