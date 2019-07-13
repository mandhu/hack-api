<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProductNameTrait;
use Tests\ApiTestTrait;

class ProductNameApiTest extends TestCase
{
    use MakeProductNameTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_name()
    {
        $productName = $this->fakeProductNameData();
        $this->response = $this->json('POST', '/api/productNames', $productName);

        $this->assertApiResponse($productName);
    }

    /**
     * @test
     */
    public function test_read_product_name()
    {
        $productName = $this->makeProductName();
        $this->response = $this->json('GET', '/api/productNames/'.$productName->id);

        $this->assertApiResponse($productName->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_name()
    {
        $productName = $this->makeProductName();
        $editedProductName = $this->fakeProductNameData();

        $this->response = $this->json('PUT', '/api/productNames/'.$productName->id, $editedProductName);

        $this->assertApiResponse($editedProductName);
    }

    /**
     * @test
     */
    public function test_delete_product_name()
    {
        $productName = $this->makeProductName();
        $this->response = $this->json('DELETE', '/api/productNames/'.$productName->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/productNames/'.$productName->id);

        $this->response->assertStatus(404);
    }
}
