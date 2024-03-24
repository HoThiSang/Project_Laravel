<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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
            if(!empty($softBy)){
                $productFilter = $this->products->getFilter($softBy);
                dd($productFilter);
            }
            
    }
}
