<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @version July 13, 2019, 8:21 am UTC
 *
 * @property string name
 * @property string email
 * @property integer is_seller
 * @property string contact_number
 * @property string wallet_balance
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public $table = 'users';
    
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public $fillable = [
        'name',
        'email',
        'password',
        'is_seller',
        'contact_number',
        'wallet_balance'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'is_seller' => 'integer',
        'email_verified_at' => 'datetime',
        'contact_number' => 'string',
        'wallet_balance' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'is_seller' => 'required',
        'contact_number' => 'required'
    ];

    
}
