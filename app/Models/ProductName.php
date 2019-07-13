<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductName
 * @package App\Models
 * @version July 13, 2019, 9:13 am UTC
 *
 * @property Product product
 * @property string name
 * @property string description
 * @property integer category_id
 */
class ProductName extends Model
{
    use SoftDeletes;

    public $table = 'product_names';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required:string',
        'description' => 'required:string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
