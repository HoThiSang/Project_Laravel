<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WishList extends Model
{
    use HasFactory;
    protected $table ='wish_lists';
    protected $fillable = [
        'user_id',
        'product_id',
        'deleted_at'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function deleteWishListById($id)
    {
        $wish_lists = $this->findOrFail($id);
        return $wish_lists->softDelete();
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

    // public function getAllWishList()
    // {
    //     $cart = DB::table($this->table)->whereNull('deleted_at')->get();
    //     return $cart;
    // }

    public function getAllWishList($user_id)
    {
        $wishlist = DB::table('wish_lists')
            ->select('products.id', 'products.product_name', 'products.category_id', 'products.price', 'products.discounted_price', DB::raw('MAX(images.image_url) as image_url'))
            ->join('products', 'wish_lists.product_id', '=', 'products.id')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereNull('products.deleted_at')
            ->where('wish_lists.user_id', $user_id)
            ->groupBy('products.id', 'products.product_name', 'products.category_id', 'products.price', 'products.discounted_price', 'products.quantity')
            ->get();
    
        return $wishlist;
    }
    
    public function getAllCarts($user_id)
    {
        return DB::table('carts')
            ->groupBy('carts.id', 'products.product_name', 'carts.price', 'products.discount')
            ->select('carts.*', 'products.product_name',  DB::raw('MAX(images.image_url) as image_url'))
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->where('carts.user_id', $user_id)
            ->get();
    }
    
}
