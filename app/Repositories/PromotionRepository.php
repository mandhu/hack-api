<?php

namespace App\Repositories;

use App\Events\NewTransaction;
use App\Listeners\Transect;
use App\Models\Listing;
use App\Models\Promotion;
use App\Repositories\BaseRepository;

/**
 * Class PromotionRepository
 * @package App\Repositories
 * @version July 13, 2019, 10:04 am UTC
*/

class PromotionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
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
        return Promotion::class;
    }

    public function promote(Listing $listing)
    {
        $promotion = new Promotion();
        $promotion->listing_id = $listing->id;
        $promotion->save();

        event(new NewTransaction($promotion));
    }
}
