<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Purchase
 * @package App\Models
 * @version July 13, 2019, 9:57 am UTC
 *
 * @property \App\Models\Buyer buyer
 * @property \App\Models\Listing listing
 * @property integer buyer_id
 * @property integer listing_id
 */
class Purchase extends Model
{
    use SoftDeletes;

    public $table = 'purchases';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'buyer_id',
        'listing_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'buyer_id' => 'integer',
        'listing_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function buyer()
    {
        return $this->belongsTo(\App\Models\Buyer::class, 'buyer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function listing()
    {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'id');
    }
}
