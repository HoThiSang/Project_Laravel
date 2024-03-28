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
    public function __construct()
    {
        $this->categories = new Categories();
    }

    public function index()
    {
        //  $products = DB::table('products')->join('images', 'products.id', '=', 'images.product_id')->get();
        $products = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discounted_price')
            ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            ->get();

        $productsWithDiscount = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discounted_price')
            ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            ->where('discount', '>', 0)
            ->get();

        $productsSuggesteds  = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discounted_price')
            ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            ->where('quantity', '<', 60)
            ->get();

        return  view('users/index', compact('products', 'productsWithDiscount', 'productsSuggesteds'));
    }

    public function getDetail(string $id)
    {
        if (!empty($id)) {
            $product = DB::table('products')
                ->join('images', 'products.id', '=', 'images.product_id')
                ->where('products.id', $id)
                ->groupBy('products.id')
                ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', 'products.description', DB::raw('MAX(images.image_url) as image_url'))
                ->first();

            $product_images = DB::table('images')
                ->where('product_id', $id)
                ->limit(1)
                ->select('image_url')
                ->get();
            // dd($product_images);

            return view('users/product-detail', compact('product', 'product_images'));
        }
    }
}
