<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'address'];
    protected $hidden = ['password'];

    public function costumes() {
        return $this->hasMany(Costume::class, 'seller_id');
    }
}
