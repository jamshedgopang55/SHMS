<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }
   
    public  function login(){
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {   
        // return $request;
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            // $user = Auth::user();
            // $role = Role::find($user->role_id);
    
            // if ($role) {
            //     // Redirect authenticated users with a role to the admin index
                return redirect()->route('admin.index');
            // } else {
                // If the role is not found, logout the user and redirect to login with an error message
                // Auth::logout();
                // return redirect()->route('user.login')->with('error', 'Invalid Email Or Password');
            // }
        } else {
            // If authentication fails, redirect to login with an error message
            return redirect()->route('user.login')->with('error', 'Invalid Email Or Password');
        }
    }
    

    public function logout(){
        if(Auth::user()){
            Auth::logout();
            return redirect()->route('user.login');
        }
       abort(404);
    }
    
    public function index()
    {
        $data = User::get();

        return view('admin.user.index', compact('data'));
        // return 
    }
    public function create()
    {

        $data['roles'] = Role::pluck('name','name')->all();
        return view('admin.user.create', $data);
    }
    public function store(Request  $request)
    {
        // return $request;
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required',
            'roles' => 'required'
            
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profile_pic/'), $imageName);
                $user->pic = 'uploads/profile_pic/' . $imageName;
            }

            $user->save();
            $user->syncRoles($request->roles);
            return redirect('/admin/user/');  
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',
        [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]
    );
    }

    public function update(Request  $request)
    {
        // return $request;
        $user =  User::findOrFail($request->id);
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|numeric',
            'roles' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $user =  User::findOrFail($request->id);
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            $user->syncRoles($request->roles);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profile_pic/'), $imageName);
                $user->pic = 'uploads/profile_pic/' . $imageName;
            }
            $user->update();
            return redirect('admin/user/');
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destory($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/user');  
    }

}
