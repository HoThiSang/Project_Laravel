<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerAll = Banner::all();
        return view('admin/banner/admin-banner', compact('bannerAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = Banner::all();
        return view('admin/banner/admin-banner-create', compact('banner'));
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
            'title' => 'required|min:3',
            'content' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $banner = new Banner;
        $banner->title = $request->input('title');
        $banner->content = $request->input('content');
        $banner->image_name = $request->input('image_name');
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalName();
            $filename = time() . '_' . $extension;
            $file->move('images/', $filename);
            $banner->image_url = $filename;
        }
        $banner->save();
        return redirect()->route('admin-banner')->with('success', 'Banner added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $banner = Banner::find($id);
        return view('admin/banner/admin-banner-update', compact('banner'));
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
            'title' => 'required|min:3',
            'content' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $banner = Banner::find($id);
        $banner->title = $request->input('title');
        $banner->content = $request->input('content');
        $banner->image_name = $request->input('image_name');
        if ($request->hasFile('image_url')) {
            $oldImage = 'images/' . $banner->image_url;
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalName();
            $filename = time() . '_' . $extension;
            $file->move('images/', $filename);
            $banner->image_url = $filename;
        }
        $banner->update();
        return redirect()->route('admin-banner')->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $oldImage = 'images/' . $banner->image_url;
        if (File::exists($oldImage)) {
            File::delete($oldImage);
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
