<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;
    protected $table ='images';

     public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }

    public function getAllImageByProductId($product_id)
    {
        
        $images = DB::table($this->table)->where('product_id', $product_id)->get();
        return $images;
    }

    

}
