<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listing
 * @package App\Models
 * @version July 13, 2019, 9:56 am UTC
 *
 * @property Seller seller
 * @property Product product
 * @property integer seller_id
 * @property integer product_id
 * @property string price
 * @property integer quantity
 * @property integer status
 * @property string expires_at
 */
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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'seller_id' => 'integer',
        'product_id' => 'integer',
        'price' => 'string',
        'quantity' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required:string',
        'quantity' => 'required:string',
        'status' => 'required:string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
