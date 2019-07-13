<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use SoftDeletes;

    public $table = 'listings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'seller_id',
        'product_id',
        'price',
        'quantity',
        'status',
        'expires_at'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
