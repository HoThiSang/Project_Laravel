<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    protected $products;
    const _PER_PAGE = 3;
    public function __construct()
    {
        $this->products = new Product();
    }


    public function filterByCategory(Request $request)
    {
        $softBy = $request->input('sort-by');
        if (!empty($softBy)) {
            $productFilter = $this->products->getFilter($softBy);
            dd($productFilter);
        }
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

            return view('users/product-detail', compact('product', 'product_images'));
        }
    }
}
