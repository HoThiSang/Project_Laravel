<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;



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
        //  $statement = $this->users->statementUser("DELETE FROM users ");
        //   $builder = $this->users->learningQueryBuilder();
        //   dd($builder);
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

        // sap xep :
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
       //   dd($userAll);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/admin-user-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required|integer',
            'username' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);
    
        User::create($validatedData);
    
        return redirect()->route('admin-user.index')->with('status', 'Thêm user thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            // Xóa tất cả các bản ghi trong bảng wish_lists liên quan đến người dùng
            $user->wishLists()->delete();
    
            // Xóa người dùng
            $user->delete();
    
            return redirect()->route('admin-user.index')->with('status', 'Xóa thành công');
        } else {
            return redirect()->route('admin-user.index')->with('error', 'Không tìm thấy người dùng');
        }
    }
}