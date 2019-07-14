<?php

namespace App\Repositories;

use App\Models\Listing;
use App\Repositories\BaseRepository;

/**
 * Class ListingRepository
 * @package App\Repositories
 * @version July 13, 2019, 9:56 am UTC
*/

class ListingRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'quantity',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Listing::class;
    }
}
