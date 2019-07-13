<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductName extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
