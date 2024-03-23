<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $softBy = $request->input('sort-by');
        if (!empty($softBy)) {
            $title = $softBy;
            $products = DB::table('products')
                ->join('images', 'products.id', '=', 'images.product_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')

                ->groupBy('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price')
                ->select('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
                ->where('categories.category_name', $softBy)
                ->get();
               // dd($products);
                Session::flash('message', 'filter');
            return   view('users/category', compact('products', 'title'));
        } else {
               $title = 'All products';
            $products = DB::table('products')
                ->join('images', 'products.id', '=', 'images.product_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')

                ->groupBy('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price')
                ->select('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
              
                ->get();
                  Session::flash('message', 'no');
            return   view('users/category', compact('products', 'title'));
        }
    }
}
