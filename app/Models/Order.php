<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price', 'status'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
