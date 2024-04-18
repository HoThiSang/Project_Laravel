<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Slide;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
        // $this->middleware('alreadyLoggedIn');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $filters = [];
        $keyword = null;
        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $filters[] = ['users.status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;

            $filters[] = ['users.status', '=', $groupId];
        }


        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }

        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type') ? $request->input('sort-type') : 'asc';
        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $userAll = $this->users->getAllUsers($sortType, $keyword);
        return view('admin/user/admin-user', compact('userAll'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAll = User::all();
        return view('admin/user/admin-user-create', compact('userAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'integer',
            'username' => 'required',
            'date_of_birth' => 'date',
            'address' => 'string',
            'image_name' => 'string',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->username = $request->input('username');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $user->password = $hashedPassword;

        $user->date_of_birth = $request->input('date_of_birth');
        $user->address = $request->input('address');

        $user->role_id = $request->input('role_id');

        if (isset($role_id)) {
            $user->role_id = $role_id;
        } else {
            $user->role_id = 1;
        }

        $user->image_name = $request->input('image_name');

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $uploadedFileUrl = Cloudinary::upload($request->file('image_url')->getRealPath(), [
                'folder' => 'upload_image'
            ])->getSecurePath();
            $publicId = Cloudinary::getPublicId();
        
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
          
            $user->image_name = $filename;
            $user->image_url = $uploadedFileUrl;
            $user->publicId = $publicId;

            
        }

        $user->save();

        return redirect()->route('admin-user')->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user_id = Auth::user()->id;

    //     $user = DB::table('users')->where('id', $user_id)->first();

    //     return view('', compact('user'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin/user/admin-user-update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'role_id' => 'integer',
            'username' => 'required',
            'date_of_birth' => 'date',
            'address' => 'string',
            'image_name' => 'string',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->address = $request->input('address');
        $user->role_id = $request->input('role_id');

        if (isset($role_id)) {
            $user->role_id = $role_id;
        } else {
            $user->role_id = 1; 
        }

        $user->image_name = $request->input('image_name');

        if ($request->hasFile('image_url')) {
            // $oldImage = 'images/' . $user->image_url;
            // if (File::exists($oldImage)) {
            //     File::delete($oldImage);
            // }
            // $file = $request->file('image_url');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time() . '.' . $extension;
            // $file->move('images/', $filename);
            // $user->image_url = $filename;
            $file = $request->file('image_url');
            $uploadedFileUrl = Cloudinary::upload($request->file('image_url')->getRealPath(), [
                'folder' => 'upload_image'
            ])->getSecurePath();
            $publicId = Cloudinary::getPublicId();
        
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
          
            $user->image_name = $filename;
            $user->image_url = $uploadedFileUrl;
            $user->publicId = $publicId;
        }

        $user->update();
        return redirect()->route('admin-user')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->carts()->delete();
            $user->orders()->delete();
            $user->delete();
            return redirect()->route('admin-user')->with('success', 'Deleted successfully');
        } else {
            return redirect()->route('admin-user')->with('error', 'User not found');
        }
    }
}
