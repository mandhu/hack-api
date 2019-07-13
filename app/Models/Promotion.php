<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'listing_id',
        'expires_at',
        'type',
        'amount'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
