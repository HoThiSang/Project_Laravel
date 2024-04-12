<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class AdminCategoryController extends Controller
{
    protected $categories;

    public function __construct()
    {
        $this->categories = new Categories();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesAll = $this->categories->getAllCategories();
        return view('admin/categories/admin-categories', compact('categoriesAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->isMethod('post')) {
            $categoryData = [
                'category_name' => $request->category_name,
                'created_at' => now()
            ];
            $category = $this->categories->createNewCategory($categoryData);
            if ($category) {
                return redirect()->back()->with('success', 'Add new category successfully');
            } else {
                return redirect()->back()->with('error', 'Add new category field');
            }
            return redirect()->back()->with('error', 'Should not empty category name ');
        }
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
        if (!empty($id)) {
            $categoryUpdate = $this->categories->getCategoryById($id);
            if (!empty($categoryUpdate)) {
                return view('admin/categories/admin-category-update', compact('categoryUpdate'));
            } else {
                return redirect()->back()->with('message', 'Not found category with id :', $id);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (!empty($id)) {
            if ($request->isMethod('post')) {
                $categoryDataUpdate = [
                    'category_name' => $request->category_name,
                    'updated_at' => now()
                ];
                $categoryUpdated = $this->categories->updateCategory($id, $categoryDataUpdate);
                if ($categoryDataUpdate) {

                    return redirect()->route('admin-categories')->with('success', 'Updated category successfully');
                } else {
                    return redirect()->route('admin-categories')->with('error', 'Update  category field');
                }
            }
            return redirect()->route('admin-categories')->with('error', 'Not found  category id: ' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id)) {
            $product = $this->categories->deleteCategoryById($id);
            if ($product) {
                return redirect()->back()->with('success', 'Deleted category successfully');
            } else {
                return redirect()->back()->with('error', 'Deleted category field');
            }
        }
    }


    public function research(Request $request)
    {
        $keyword = $request->input('category_name');
        $categoryFind = $this->categories->searchByKeyWord($keyword);
        return view('admin/categories/admin-categories', compact('categoryFind'));
    }
}
