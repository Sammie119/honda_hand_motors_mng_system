<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('login');
        } else {
            return back();
        }
    }

    public function adminHome()
    {
        return view('admin.dashboard');
    }

    public function userHome()
    {
        return view('users.home');
    }

    public function postRegistration(Request $request)
    {
        if($request->has('id')){
            if(isset($request->password)){
                request()->validate([
                    'name' => 'required',
                    'username' => 'required|unique:users,username,'.$request->id.',user_id',
                    'mobile_no' => 'required',
                    'user_level' => 'required',
                    'department' => 'required',
                    'password' => 'required|min:6|same:confirm_password',
                    'confirm_password' => 'required|min:6|same:password'
                ]);

            } else {
                request()->validate([
                    'name' => 'required',
                    'username' => 'required|unique:users,username,'.$request->id.',user_id',
                    'mobile_no' => 'required',
                    'user_level' => 'required',
                    'department' => 'required',
                ]);
            }
            
            $user = User::find($request->id);
    
            $user->update([
                'name' => $request['name'],
                'mobile_no' => $request['mobile_no'],
                'user_level' => $request['user_level'],
                'department' => $request['department'],
                'password' => (isset($request->password)) ? Hash::make($request['password']) : $user->password,
            ]);
    
            return back()->with('success', 'User Updated Successfully Created!!');
        }

        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'mobile_no' => 'required',
            'user_level' => 'required',
            'department' => 'required',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'mobile_no' => $request['mobile_no'],
            'user_level' => $request['user_level'],
            'department' => $request['department'],
            'password' => Hash::make($request['password'])
        ]);

        return back()->with('success', 'New User Successfully Created!!');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...dashboard
            if (Auth()->user()->user_level === 'Super Admin') {
                
                // dd(Auth::user()->user_level);
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('dashboard');
            } else {
                
                Session::flash('success', 'Logged in Successfully!');
                return redirect()->intended('home');
            }
        }
        
        return back()->with('error', 'Oppes! You have entered invalid credentials!');
    }

    public function usersList()
    {
        $users = User::where('user_id', '!=', 1)->get();
        return view('admin.user_list', ['users' => $users]);
    }

    public function profileStore(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$request->id.',user_id',
            'mobile_no' => 'required',
            'user_level' => 'required',
            'department' => 'required',
            'password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6|same:password'
        ]);

        $user = User::find($request->id);

        if(isset($request->password)) {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'mobile_no' => $request['mobile_no'],
                'user_level' => $request['user_level'],
                'department' => $request['department'],
                'password' => Hash::make($request['password'])
            ]);
        }
        else {
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'mobile_no' => $request['mobile_no'],
                'user_level' => $request['user_level'],
                'department' => $request['department'],
            ]);
        }

        return $this->logout();
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User Deleted Successfully Created!!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
