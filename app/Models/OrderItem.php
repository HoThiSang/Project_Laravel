<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    use HasFactory;
    protected $table ='order_items';

    public function creatNewOrderItem($data)
    {
        return DB::table($this->table)->insert($data);
    }


    public static function calculateRevenueInMonth($month)
    {
        return static::whereMonth('created_at', $month)->sum(DB::raw('quantity * unit_price'));
    }
}
