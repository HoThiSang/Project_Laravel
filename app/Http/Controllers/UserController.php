<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $user = DB::table('users')->where('id', $user_id)->first();

        return view('users.user-profile', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
      
        if ($request->isMethod('post')) {

            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'phone' => 'required|digits:10',
                'address' => 'required',
            ]);
          
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
    
            if ($user) {
            
                return redirect()->back()->with('message', 'Updated your information successfully !');
            } else {
                return redirect()->back()->with('error', 'Update your information failed !');
            }
        }
        return redirect()->back()->with('error', 'Not found user with id '. $id);
    }
}
