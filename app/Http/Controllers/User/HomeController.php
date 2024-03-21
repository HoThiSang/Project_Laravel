<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //  $products = DB::table('products')->join('images', 'products.id', '=', 'images.product_id')->get();
        $products = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discounted_price')
            ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            
            ->get();
     //   dd($products);
     //   $productsWithDiscount = Product::where('discount', '>', 0)->get();
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
}
