<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Costume extends Model
{
    use HasFactory;

    protected $fillable = ['seller_id', 'name', 'description', 'price', 'image_url'];

    public function seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }
}

