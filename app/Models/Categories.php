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
}
