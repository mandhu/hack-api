<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;

trait MakePromotionTrait
{
    /**
     * Create fake instance of Promotion and save it in database
     *
     * @param array $promotionFields
     * @return Promotion
     */
    public function makePromotion($promotionFields = [])
    {
        /** @var PromotionRepository $promotionRepo */
        $promotionRepo = \App::make(PromotionRepository::class);
        $theme = $this->fakePromotionData($promotionFields);
        return $promotionRepo->create($theme);
    }

    /**
     * Get fake instance of Promotion
     *
     * @param array $promotionFields
     * @return Promotion
     */
    public function fakePromotion($promotionFields = [])
    {
        return new Promotion($this->fakePromotionData($promotionFields));
    }

    /**
     * Get fake data of Promotion
     *
     * @param array $promotionFields
     * @return array
     */
    public function fakePromotionData($promotionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'listing_id' => $fake->randomDigitNotNull,
            'expires_at' => $fake->date('Y-m-d H:i:s'),
            'type' => $fake->word,
            'amount' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $promotionFields);
    }
}
