<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Purchase;
use App\Repositories\PurchaseRepository;

trait MakePurchaseTrait
{
    /**
     * Create fake instance of Purchase and save it in database
     *
     * @param array $purchaseFields
     * @return Purchase
     */
    public function makePurchase($purchaseFields = [])
    {
        /** @var PurchaseRepository $purchaseRepo */
        $purchaseRepo = \App::make(PurchaseRepository::class);
        $theme = $this->fakePurchaseData($purchaseFields);
        return $purchaseRepo->create($theme);
    }

    /**
     * Get fake instance of Purchase
     *
     * @param array $purchaseFields
     * @return Purchase
     */
    public function fakePurchase($purchaseFields = [])
    {
        return new Purchase($this->fakePurchaseData($purchaseFields));
    }

    /**
     * Get fake data of Purchase
     *
     * @param array $purchaseFields
     * @return array
     */
    public function fakePurchaseData($purchaseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'buyer_id' => $fake->randomDigitNotNull,
            'listing_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $purchaseFields);
    }
}
