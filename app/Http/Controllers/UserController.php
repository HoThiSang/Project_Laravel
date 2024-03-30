<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $user_id = 1;
        } else {
            $user_id = $id;
        }


        $user = DB::table('users')->where('id', $user_id)->first();

        return view('users.user-profile', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $message = 'failed';

        if ($request->isMethod('post')) {

            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'phone' => 'required|digits:10',
                'address' => 'required',
            ]);
           // dd($request->user_id);
            $user = new User();
   
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = $request->password;
            $user->date_of_birth = $request->date;
            $user->role_id = $request->role_id;;
            $user->updated_at = now();
            $user->save();

       // dd($user);
            
            if ($user) {
                $message='success';
                return redirect()->back()->with($message);
            } else {
                return redirect()->back()->with($vvv);
            }
        }
        return redirect()->back()->with($message);
    }
}
