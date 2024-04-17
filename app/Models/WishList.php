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

    public function getAllWishList()
    {
        $cart = DB::table($this->table)->whereNull('deleted_at')->get();
        return $cart;
    }

    
}
