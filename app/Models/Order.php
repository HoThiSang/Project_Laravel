<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';

    public function creatNewOrder($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
}
