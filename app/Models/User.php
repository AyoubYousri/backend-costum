<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject; // <-- Add this line

class User extends Authenticatable implements JWTSubject // <-- Implement JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'address'];
    protected $hidden = ['password'];

    public function costumes() {
        return $this->hasMany(Costume::class, 'seller_id');
    }

    // Add these two methods as required by JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}