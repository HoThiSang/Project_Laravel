<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUsers($orderBy, $keyword)
    {
        $users = DB::table('users')->get();
        if (!empty($keyword)) {
            $users = $users->orderBy('users.' . $orderBy, $keyword);
            $users = $users->where(function ($query) use ($keyword) {
                $query->orwhere('name', 'like', '%' . $keyword . '%');
                $query->orwhere('email', 'like', '%' . $keyword . '%');
            });
        }
        return $users;
    }

    public function createUser($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishLists()
    {
        return $this->hasMany(WishList::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
