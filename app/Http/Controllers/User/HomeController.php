<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $categories;
    protected $products;
    protected $banner;

    public function __construct()
    {
        $this->categories = new Categories();
        $this->products = new Product();
        $this->banner = new Banner();
    }

    public function index()
    {
      
        $products = $this->products->getAllProducts();
        $productsWithDiscount  = $this->products->getAllProductByDiscount();
        $productsSuggesteds = $this->products->getAllProductBySugest();
        $bannerAll = $this->banner->getAllBanner();
        // dd($products);
        return  view('users/index', compact('products', 'productsWithDiscount', 'productsSuggesteds', 'bannerAll'));
    }

    public function getDetail(string $id)
    {
        if (!empty($id)) {
            $product = Product::find($id);
            $product_images = DB::table('images')
            ->where('product_id', $product->id)
            ->get();
            $price = $product->price;
            $discountedPrice = $product->discounted_price;
            $displayPrice = $discountedPrice ? $discountedPrice : $price;
            return view('users/product-detail', compact('product', 'product_images', 'price', 'discountedPrice'));
        }
    }

    public function contact()
    {
            return view('users/contact');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword_submitted');
    
        $products = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.product_name', 'like', '%' . $keyword . '%')
            ->groupBy('products.id', 'products.product_name', 'products.category_id', 'products.price', 'products.discounted_price')
            ->select('products.id', 'products.product_name', 'products.category_id', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            ->get();
    
        return view('users.search', compact('products', 'keyword'));
    }

}
