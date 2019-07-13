<?php

namespace App\Repositories;

use App\Models\Transfer;
use App\Repositories\BaseRepository;

/**
 * Class TransferRepository
 * @package App\Repositories
 * @version July 13, 2019, 10:19 am UTC
*/

class TransferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Transfer::class;
    }
}
