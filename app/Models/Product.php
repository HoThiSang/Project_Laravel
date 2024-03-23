<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function getFilter($filter)
    {
        $products = DB::table($this->table)
            ->select('products.*', 'categories.category_name as category_name')
            ->join('categories', 'users.category_id', '=', 'categories.id')
            ->where('category_name', $filter);
        return $products;
    }
}
