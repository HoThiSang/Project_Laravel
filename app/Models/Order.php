<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'deleted_at',
    ];
    public function creatNewOrder($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function deleteOrderById($id)
    {
        $order = $this->findOrFail($id);
        return $order->softDelete();
    }

    /**
     * 
     *
     * @return bool
     */
    public function softDelete()
    {
        return $this->update(['deleted_at' => Carbon::now()]);
    }

    public function getAllOrder()
    {
        return Order::join('users', 'users.id', '=', 'orders.user_id')
            ->whereNull('orders.deleted_at')
            ->select('orders.id','orders.phone_number','orders.phone_number', 'orders.order_status','orders.order_total',  'orders.payment_method','orders.created_at','users.username', 'users.phone')
            ->get();
    }
}
