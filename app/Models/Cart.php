<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected static function boot()
    {
        parent::boot();

        // Đăng ký sự kiện 'creating' để tự động đặt user_id thành 1 trước khi tạo mới một bản ghi
        // static::creating(function ($cart) {
        //     $cart->user_id = 1;
        // });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAllCart($user_id)
    {
        $cart = DB::table('carts')->where('user_id', $user_id)->get();
        return $cart;
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