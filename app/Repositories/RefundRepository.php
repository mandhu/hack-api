<?php

namespace App\Repositories;

use App\Events\NewTransaction;
use App\Listeners\Transect;
use App\Models\Listing;
use App\Models\Promotion;
use App\Models\Refund;
use App\Repositories\BaseRepository;

/**
 * Class RefundRepository
 * @package App\Repositories
 * @version July 13, 2019, 10:04 am UTC
*/

class RefundRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'remarks',
        'amount'
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
        return Refund::class;
    }
}
