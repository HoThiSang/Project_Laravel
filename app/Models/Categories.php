<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Categories extends Model
{
    use HasFactory;
    protected $table ='categories';
    protected $fillable = ['category_name'];


     public function getAllCategories()
    {
        $categories  = DB::table($this->table)->get();
        
        return $categories;
    }

     public function getCategoryById($id)
    {
        $categories  = DB::table($this->table)->where('id', $id)->first();
        return $categories;
    }
}
