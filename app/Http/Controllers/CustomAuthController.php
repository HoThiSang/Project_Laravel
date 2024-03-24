<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Hash as FacadesHash;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('users/login');
    }

    public function registration()
    {
        return view('users/register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);
        $user = new User();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $res = $user->save();
        if ($res) {
            return back()->with('success', 'You have registered successfuly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|',
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password not matches.');
            }
        } else {
            return back()->with('fail', 'This email is not registered.');
        }
    }

    public function dashboard()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('users/category', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
