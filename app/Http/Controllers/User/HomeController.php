<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $categories;
    protected $products;

    public function __construct()
    {
        $this->categories = new Categories();
        $this->products = new Product();
    }

    public function index()
    {
      
        $products = $this->products->getAllProducts();
        $productsWithDiscount  = $this->products->getAllProductByDiscount();
        $productsSuggesteds = $this->products->getAllProductBySugest();
        return  view('users/index', compact('products', 'productsWithDiscount', 'productsSuggesteds'));
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

}
