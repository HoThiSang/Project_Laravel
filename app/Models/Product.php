<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    
    protected $fillable = [

        'name', 'description', 'price', 'deleted_at',
    ];

    
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
 
        $products = DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price',  'products.quantity')
            ->select('products.id', 'products.product_name', 'products.category_id',  'products.price', 'products.discounted_price', 'products.quantity', DB::raw('MAX(images.image_url) as image_url'))
            ->whereNull('products.deleted_at')
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
        return DB::table($this->table)->insertGetId($data);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function updateProduct($id, $data)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->update($data);
    }

    public static function findById($id)
    {
        return self::find($id);
    }


    public function deleteProductById($id)
    {
        $product = $this->findOrFail($id);
        return $product->softDelete();
    }

    /**
     * Đánh dấu sản phẩm là đã xóa mềm bằng cách cập nhật trường deleted_at.
     *
     * @return bool
     */
    public function softDelete()
    {
        
        return $this->update(['deleted_at' => Carbon::now()]);
    }
    
    public function subtractQuantity($product_id, $quantityToSubtract)
    {

        $currentQuantity = DB::table($this->table)->where('id', $product_id)->value('quantity');

        if ($currentQuantity >= $quantityToSubtract) {
            $newQuantity = $currentQuantity - $quantityToSubtract;
            DB::table($this->table)->where('id', $product_id)->update(['quantity' => $newQuantity]);
            return true;
        } else {
            return false;
        }
    }

    public function getAllProductSortedByPriceDesc()
    {
        return $this->orderBy('price', 'desc')->get();
    }

    public function getAllProductSortedByQuantityDesc()
    {
        return $this->orderBy('quantity', 'desc')->get();
    }

    public function getAllProducts() 
    {
      return  DB::table('products')
        ->join('images', 'products.id', '=', 'images.product_id')
        ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discount')
        ->select('products.id', 'products.product_name', 'products.price', 'products.discount', DB::raw('MAX(images.image_url) as image_url'), DB::raw('(products.price * (1 - products.discount/100)) as discounted_price'))
        ->get();

    }

    public function getAllProductByDiscount() 
    {
        return   DB::table('products')
        ->join('images', 'products.id', '=', 'images.product_id')
        ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discount')
        ->select('products.id', 'products.product_name', 'products.price', 'products.discount', DB::raw('MAX(images.image_url) as image_url'), DB::raw('(products.price * (1 - products.discount/100)) as discounted_price'))
        ->where('discount', '>', 0)
        ->get();

    }

    // public function getAllProductBySugest() 
    // {
    //     return DB::table('products')
    //     ->join('images', 'products.id', '=', 'images.product_id')
    //     ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discounted_price')
    //     ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
    //     ->where('quantity', '<', 40)
    //     ->get();
    // }
//     public function getAllProductBySugest()
// {
//     return DB::table('products')
//         ->join('images', 'products.id', '=', 'images.product_id')
//         ->groupBy('products.id', 'products.product_name', 'products.price', 'products.price', 'products.discounted_price')
//         ->select('products.id', 'products.product_name', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'), DB::raw('(products.price - products.discounted_price) as discounted'))
//         ->where('quantity', '<', 40)
//         ->get();
// }
public function getAllProductBySugest()
{
    return DB::table('products')
        ->join('images', 'products.id', '=', 'images.product_id')
        ->groupBy('products.id', 'products.product_name', 'products.price', 'products.discount')
        ->select('products.id', 'products.product_name', 'products.price', 'products.discount',
         DB::raw('MAX(images.image_url) as image_url'), DB::raw('(products.price * (1 - products.discount/100)) as discounted_price'))
        ->where('quantity', '<', 40)
        ->get();
}
}
