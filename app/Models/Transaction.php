<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 * @version July 13, 2019, 10:08 am UTC
 *
 * @property string amount
 * @property integer transactionable_id
 * @property integer transactionable_type
 * @property string expires_at
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'amount',
        'transactionable_id',
        'transactionable_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'string',
        'transactionable_id' => 'integer',
        'transactionable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required:string',
        'transactionable_id' => 'required',
        'transactionable_type' => 'required'
    ];

}
