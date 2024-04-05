<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class AdminProductController extends Controller
{
    protected $products;
    protected $categories;
    protected $image;

    public function __construct()
    {
        $this->products = new Product();
        $this->categories = new Categories();
        $this->image = new Image();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productAll = $this->products->getAllProduct();
        //   dd($productAll);
        return view('admin/products/admin-product', compact('productAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryAll = $this->categories->getAllCategories();
        return view('admin/products/admin-product-create', compact('categoryAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($request->isMethod('post')) {
            if (
                isset($request->product_name) && isset($request->price) && isset($request->discount)
                && isset($request->quantity) && isset($request->description) && isset($request->ingredient)
                && isset($request->category_id) && isset($request->category_id)
            ) {
                $dataInsert = [
                    'product_name' => $request->product_name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'ingredient' => $request->ingredient,
                    'description' => $request->description,
                    'brand' => $request->brand,
                    'discount' => $request->discount,
                    'discounted_price' => 30000,
                    'category_id' => $request->category_id,
                    'created_at' => now()
                ];
                $product_id = $this->products->creatNewProduct($dataInsert);

                if ($product_id > 0) {
                    $imamg = $request->url;
                  
                    $dataImage = [
                        'image_name' => $request->product_name,
                        'image_url' =>    $imamg ,
                        'product_id' => $product_id,
                        'created_at' => now()
                    ];
                    $imageSuccess = $this->image->createImageByProductId($dataImage);

                    if ($imageSuccess) {
                        return redirect()->route('admin.product-index')->with('success', 'Product added successfully');
                    } else {
                        return redirect()->route('admin.product-index')->with('error', 'Failed to add Image');
                    }
                } else {
                    return redirect()->route('admin.product-index')->with('error', 'Failed to add product');
                }
            } else {
                return redirect()->route('admin.product-index')->with('error', 'Missing required fields');
            }
        }
    }

    public function saveImage(Request $request, $product_id, $url)
    {
        $request->validate([
            'url' => 'required|url',
        ]);
        $this->image->url = $request->url;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productDetail = $this->products->getProductById($id);
        $imageAll = $this->image->getAllImageByProductId($id);
        $category_id = $productDetail->category_id;
        $category = $this->categories->getCategoryById($category_id);
        return view('admin/products/admin-product-detail', compact('productDetail', 'imageAll', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productDetail = $this->products->getProductById($id);
        $imageAll = $this->image->getAllImageByProductId($id);
        $category_id = $productDetail->category_id;
        $category = $this->categories->getCategoryById($category_id);
        return view('admin/products/admin-product-update', compact('productDetail', 'imageAll', 'category'));
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
        //
    }
}
