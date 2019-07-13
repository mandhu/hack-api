<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ProductName;
use App\Repositories\ProductNameRepository;

trait MakeProductNameTrait
{
    /**
     * Create fake instance of ProductName and save it in database
     *
     * @param array $productNameFields
     * @return ProductName
     */
    public function makeProductName($productNameFields = [])
    {
        /** @var ProductNameRepository $productNameRepo */
        $productNameRepo = \App::make(ProductNameRepository::class);
        $theme = $this->fakeProductNameData($productNameFields);
        return $productNameRepo->create($theme);
    }

    /**
     * Get fake instance of ProductName
     *
     * @param array $productNameFields
     * @return ProductName
     */
    public function fakeProductName($productNameFields = [])
    {
        return new ProductName($this->fakeProductNameData($productNameFields));
    }

    /**
     * Get fake data of ProductName
     *
     * @param array $productNameFields
     * @return array
     */
    public function fakeProductNameData($productNameFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'category_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $productNameFields);
    }
}
