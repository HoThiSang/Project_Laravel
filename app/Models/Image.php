<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;
    protected $table ='images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
