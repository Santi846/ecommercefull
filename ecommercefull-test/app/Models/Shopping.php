<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerToken;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'total'
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerToken::class);
    }

}
