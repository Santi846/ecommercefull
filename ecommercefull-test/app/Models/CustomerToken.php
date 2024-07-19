<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shopping;

class CustomerToken extends Model
{
    use HasFactory;

    protected $fillable = [

        'access_token',
        'refresh_token',
        'expires_in',
        'money'
    ];


    public function shoppings()
    {
        return $this->hasMany(Shopping::class);
    }
}
