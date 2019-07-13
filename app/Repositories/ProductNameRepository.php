<?php

namespace App\Repositories;

use App\Models\ProductName;
use App\Repositories\BaseRepository;

/**
 * Class ProductNameRepository
 * @package App\Repositories
 * @version July 13, 2019, 9:13 am UTC
*/

class ProductNameRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return ProductName::class;
    }
}
