<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];

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

    public function updateWallet($amount)
    {
        $this->wallet_balance = $this->wallet_balance + $amount;
        $this->save();
    }
}
