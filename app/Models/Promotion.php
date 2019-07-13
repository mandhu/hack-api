<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Promotion
 * @package App\Models
 * @version July 13, 2019, 10:04 am UTC
 *
 * @property Listing listing
 * @property integer listing_id
 * @property string expires_at
 * @property string type
 * @property string amount
 */
class Promotion extends Model
{
    use SoftDeletes;

    public $table = 'promotions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'listing_id',
        'expires_at',
        'type',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'listing_id' => 'integer',
        'type' => 'string',
        'amount' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required:string',
        'amount' => 'required:string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
