<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transfer
 * @package App\Models
 * @version July 13, 2019, 10:19 am UTC
 *
 * @property \App\Models\User user
 * @property string amount
 * @property string type
 * @property integer user_id
 */
class Transfer extends Model
{
    use SoftDeletes;

    public $table = 'transfers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'amount',
        'type',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'string',
        'type' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required:string',
        'type' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
