<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:view user', ['only' => ['index']]);
        // $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        // $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        // $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function changePassword()
    {

       
        // Retrieve the user with the given email
        $user = User::where('email', 'admin@admin.com')->first();

        if ($user) {
            // Set the new password
            $newPassword = '1'; // Replace with the new password

            // Hash the new password
            $hashedPassword = Hash::make($newPassword);

            // Update the user's password
            $user->password = $hashedPassword;
            $user->save();

            return "Password updated successfully!";
        } else {
            return "User with email admin@admin.com not found!";
        }
    }

    public  function login()
    {  
        Auth::logout();
        // return Auth::user();
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


    public function logout()
    {
        if (Auth::user()) {
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
        $data['schedules'] =  Schedule::get();
        $data['roles'] = Role::pluck('name', 'name')->all();
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
            $user->schedule_id = $request->schedule_id;
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
        // return 'sdf';
        $user = User::findOrFail($id);
        $schedules =  Schedule::get();
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view(
            'admin.user.edit',
            [
                'user' => $user,
                'roles' => $roles,
                'userRoles' => $userRoles,
                'schedules' => $schedules
            ]
        );
    }

    public function update(Request  $request)
    {
        // return $request;
        $user =  User::findOrFail($request->id);
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric',
            'roles' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $user =  User::findOrFail($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->schedule_id = $request->schedules;


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
    public function destory($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/user');
    }

    public function profileEdit()
    {
        $user = Auth::user();

        // return $user;
        return view('admin.user.account.profile');

        // return view('profile.edit', ['user' => $user]);
    }
    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|different:current_password',
            'verify_password' => 'nullable|string|same:new_password',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // return $request->new_password;

        // Update user profile
        $userId = Auth::user()->id;
        $user =  User::find($userId);
        // return $user;


        // Update password if provided
        if ($request->filled('new_password')) {
            // return 'sfs';
            // Check if current password matches
            if (Hash::check($request->current_password, $user->password)) {
                // Update password
                $user->password = Hash::make($request->new_password);
            } else {
                return response()->json(['error' => 'Current password does not match'], 400);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Upload and update image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profiles/'), $imageName);
            $user->image = 'uploads/profiles/' . $imageName;
        }

        $user->save();

        return response()->json(['success' => 'Profile updated successfully'], 200);

        // return response()->json(['success' => 'Profile updated successfully'], 200);
    }
    public function processForgetPassword(Request $req)
    {
        // return $$req->emai;
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        } else {
            $token = Str::random(60);
            DB::table('password_reset_tokens')->where('email', $req->email)->delete();
            DB::table('password_reset_tokens')->insert([
                'email' => $req->email,
                'token' => $token,
                'created_at' => now()
            ]);

            $user = User::where('email', $req->email)->first();
            //Send Email
            $formData = [
                'token' => $token,
                'user' => $user,
                'mailSubject' => 'You have requested to reset your Password.'
            ];



            Mail::to($req->email)->send(new ResetPasswordEmail($formData));

            session()->flash('success', $req->email);
            return response()->json([
                'status' => true,
                'message' => 'Please Check your inbox to reset Your Password'
            ]);
        }
        // $user = User::find($request->user_id);

    }
    public function authConfirm()
    {
        return view('admin.user.account.authConfirm');
    }
    public function resetPasswordForm($token)
    {


        $tokenExist = DB::table('password_reset_tokens')->where('token', $token)->first();
        if ($tokenExist ==  null) {
            return redirect()->route('user.login')->with('error', 'Invalid Request');
        }
        // return view('front.account.resetPassword',[
        //     'token'=> $token,
        // ]);

        return view('admin.user.account.resetPassword', compact('token'));
    }
    public function processResetPassword(Request $req)
    {

        $tokenObj = DB::table('password_reset_tokens')->where('token', $req->token)->first();
        if ($tokenObj ==  null) {
            return redirect()->route('user.login')->with('error', 'Invalid Request');
        }
        $user = User::where('email', $tokenObj->email)->first();

        // return $user;


        $validator = Validator::make($req->all(), [
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        } else {
            User::where('id', $user->id)->update([
                'password' => Hash::make($req->password)
            ]);
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            session()->flash('success', 'You have successfully updated your password');
            return response()->json([
                'status' => true,
                'message' => 'You have successfully updated your password',
            ]);
        }
    }
}
