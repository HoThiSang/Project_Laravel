<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'image_name'
    ];
    protected $table = 'banners';


    public function getAllBanner() 
    {
        return DB::table($this->table)->get();
    }
}