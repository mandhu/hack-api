<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Listing;
use App\Repositories\ListingRepository;

trait MakeListingTrait
{
    /**
     * Create fake instance of Listing and save it in database
     *
     * @param array $listingFields
     * @return Listing
     */
    public function makeListing($listingFields = [])
    {
        /** @var ListingRepository $listingRepo */
        $listingRepo = \App::make(ListingRepository::class);
        $theme = $this->fakeListingData($listingFields);
        return $listingRepo->create($theme);
    }

    /**
     * Get fake instance of Listing
     *
     * @param array $listingFields
     * @return Listing
     */
    public function fakeListing($listingFields = [])
    {
        return new Listing($this->fakeListingData($listingFields));
    }

    /**
     * Get fake data of Listing
     *
     * @param array $listingFields
     * @return array
     */
    public function fakeListingData($listingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'seller_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'price' => $fake->word,
            'quantity' => $fake->randomDigitNotNull,
            'status' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'expires_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $listingFields);
    }
}
