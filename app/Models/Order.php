<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    protected $table ='orders';

    public function creatNewOrder($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
  


    use SoftDeletes;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    protected $fillable = [
        'username', 'address', 'phone_number', 'payment_method'
    ];
}
