<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';


    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_id', 'id');
    }

    public function getFilter($filter)
    {
        $products = DB::table($this->table)
            ->select('products.*', 'categories.category_name as category_name')
            ->join('categories', 'users.category_id', '=', 'categories.id')
            ->where('category_name', $filter);
        return $products;
    }

    public function getAllProduct()
    {
        //  $products = DB::table('products')->get();
        $products = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price',  'products.quantity')
            ->select('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price', 'products.quantity', DB::raw('MAX(images.image_url) as image_url'))
            ->get();

        return $products;
    }

    protected static function booted()
    {
        static::addGlobalScope('id', function ($builder) {
            $builder->with(['images' => function ($query) {
                $query->where('images.id', 1);
            }]);
        });
    }

    public function getProductById($id)
    {
        $productDetail = DB::table($this->table)->where('id', $id)->first();
        return $productDetail;
    }

    public function creatNewProduct($data)
    {

        //   DB::insert('INSERT INTO users (name, email, created_at) values (?,?,?)', $data);
        return DB::table($this->table)->insert($data);
    }
}
