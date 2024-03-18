<?php

namespace App\Http\Controllers\Roles_and_Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
        public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create','store']]);
        $this->middleware('permission:update permission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('Roles_and_Permission.permissions.index', ['permissions' => $permissions]);
    }
    public function create()
    {
        return view('Roles_and_Permission.permissions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.Permission.index')->with('status', 'Permission Created Successfully');
    }
    public function edit(Permission $permission)
    {
        return view('Roles_and_Permission.permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request)
    {
        $permission = Permission::findOrFail($request->id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.Permission.index')->with('status', 'Permission Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $permission = Permission::findOrFail($request->id);
        $permission->delete();
        return redirect()->route('admin.Permission.index')->with('status', 'Permission Deleted Successfully');
    }
}
