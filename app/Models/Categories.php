<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['category_name', 'deleted_at'];


    public function getAllCategories()
    {
        $categories  = DB::table($this->table)->whereNull('deleted_at')
            ->orWhere('deleted_at', '>', now())->get();

        return $categories;
    }

    public function getCategoryById($id)
    {
        $categories  = DB::table($this->table)->where('id', $id)->first();
        return $categories;
    }

    public function createNewCategory($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function deleteCategoryById($id)
    {
        $product = $this->findOrFail($id);
        return $product->softDelete();
    }

    /**
     *
     * @return bool
     */
    public function softDelete()
    {

        return $this->update(['deleted_at' => Carbon::now()]);
    }

    // public function searchByKeyWord($keyword)
    // {
    //     return  DB::table($this->table)->where('category_name', 'LIKE', '%' . $keyword . '%')-> whereNull('deleted_at')
    //         ->orWhere('deleted_at', '>', now())->get();
    // }

    public function searchByKeyWord($keyword)
    {
        return DB::table($this->table)
            ->where(function ($query) use ($keyword) {
                $query->where('category_name', 'LIKE', '%' . $keyword . '%')
                    ->whereNull('deleted_at');
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('category_name', $keyword)
                    ->whereNull('deleted_at');
            })
            ->get();
    }

    public function updateCategory($id, $data)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->update($data);
    }
}
