<?php

namespace App\Http\Controllers\Roles_and_Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        $Roles = Role::get();

        return view('Roles_and_Permission.role.index', compact('Roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions  = Permission::get();
        return view('Roles_and_Permission.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.roles.index')->with('success', 'Roles created successfully!');
    }
    public function edit(Role $role)
    {
        return view('Roles_and_Permission.role.edit', [
            'role' => $role
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $request->id
            ]
        ]);

        $role = Role::findOrFail($request->id);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index')->with('status', 'Role Updated Successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('status', 'Role Deleted Successfully');
    }
    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('Roles_and_Permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }
    public function givePermissionToRole(Request $request, $roleId)
    {
        // $request->validate([
        //     'permission' => 'required'
        // ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permissions added to role');
    }
}
