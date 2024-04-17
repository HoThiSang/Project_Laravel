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
        // $this->middleware('alreadyLoggedIn');
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
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);

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


                        $dataImage = [
                            'image_name' => $request->product_name,
                            'image_url' =>  $imageName,
                            'product_id' => $product_id,
                            'created_at' => now()
                        ];

                        $imageSuccess = $this->image->createImageByProductId($dataImage);

                        if ($imageSuccess) {
                            return redirect()->route('product-index')->with('success', 'Product added successfully');
                        } else {
                            return redirect()->route('product-index')->with('error', 'Failed to add Image');
                        }
                    } else {
                        return redirect()->route('product-index')->with('error', 'Failed to add product');
                    }
                } else {
                    return redirect()->back()->with('error', 'Missing image fields');
                }
            } else {
                return redirect()->back()->with('error', 'Missing required fields');
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
        $categoryAll = $this->categories->getAllCategories();
        $category = $this->categories->getCategoryById($category_id);
     
        return view('admin/products/admin-product-update', compact('productDetail', 'imageAll', 'category', 'categoryAll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->products->findById($id);
        if (!empty($product)) {

            if ($request->isMethod('post')) {

                if ($request->hasFile('images')) {

                    // $image = $request->file('images');
                    // $imageName = time() . '_' . $image->getClientOriginalName();
                    // $image->move(public_path('images'), $imageName);

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
                        'updated_at' => now()
                    ];
                    $product_id = $this->products->updateProduct($id, $dataInsert);

                    if ($product_id > 0) {
                        $imageSuccess = true;
                        $successCount = 0;
                        $imageData = [];
                        foreach ($request->file('images') as $image) {
                            $imageName = $image->getClientOriginalName();
                            $image->move(public_path('images'), $imageName);
                            $imageData = [
                                'image_name' => $request->product_name,
                                'image_url' => $imageName,
                                'product_id' => $product_id,
                                'updated_at' => now()
                            ];
                            $images = $this->image->updateImage($product_id, $imageData);
                    
                            if ($imageData) {
                                $successCount++;
                            }
                        }

                        // Lưu trữ dữ liệu ảnh vào cơ sở dữ liệu


                        if ($successCount == count($request->file('images'))) {
                            return redirect()->route('product-index')->with('success', 'All images added successfully');
                        } else {
                            return redirect()->route('product-index')->with('error', 'Some images failed to add');
                        }
                        if ($imageSuccess) {
                            return redirect()->route('product-index')->with('success', 'Product added successfully');
                        } else {
                            return redirect()->route('product-index')->with('error', 'Failed to add Image');
                        }
                    } else {
                        return redirect()->route('product-index')->with('error', 'Failed to add product');
                    }
                } else {
                    return redirect()->back()->with('error', 'Missing image fields');
                }
            } else {
                return redirect()->back()->with('error', 'Missing required fields');
            }
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
            $product = $this->products->deleteProductById($id);
            return redirect()->route('product-index')->with('success', 'Product deleted successfully');
        }
        return redirect()->back()->with('error', 'Product deleted fields');

    }

    public function sortByPriceDesc()
    {
        $productAll = Product::with('images')->orderBy('price', 'desc')->get();
        return view('admin.products.admin-product', compact('productAll'));
    }

    public function sortByQuantityDesc()
    {

        $productAll = Product::with('images')->orderBy('quantity', 'desc')->get();
        return view('admin.products.admin-product', compact('productAll'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $productAll = Product::where('product_name', 'like', "%$keyword%")->with('images')->get();

        if ($productAll->isEmpty()) {
            return redirect()->back()->with('error', 'No products found.');
        }

        return view('admin.products.admin-product', compact('productAll'));
    }




}
