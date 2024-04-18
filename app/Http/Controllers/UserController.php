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

    public function adminProfile()
    {
        $user_id = Auth::user()->id;

        $user = DB::table('users')->where('id', $user_id)->first();
        return view('admin.admin-profile', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required',
        ]);

        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = User::find($id);

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->role_id = $request->role_id;
        $user->updated_at = now();
        $user->save();
        return redirect()->back()->with('message', 'Updated your information successfully!');
    }
    
}
