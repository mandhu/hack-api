<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePromotionTrait;
use Tests\ApiTestTrait;

class PromotionApiTest extends TestCase
{
    use MakePromotionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_promotion()
    {
        $promotion = $this->fakePromotionData();
        $this->response = $this->json('POST', '/api/promotions', $promotion);

        $this->assertApiResponse($promotion);
    }

    /**
     * @test
     */
    public function test_read_promotion()
    {
        $promotion = $this->makePromotion();
        $this->response = $this->json('GET', '/api/promotions/'.$promotion->id);

        $this->assertApiResponse($promotion->toArray());
    }

    /**
     * @test
     */
    public function test_update_promotion()
    {
        $promotion = $this->makePromotion();
        $editedPromotion = $this->fakePromotionData();

        $this->response = $this->json('PUT', '/api/promotions/'.$promotion->id, $editedPromotion);

        $this->assertApiResponse($editedPromotion);
    }

    /**
     * @test
     */
    public function test_delete_promotion()
    {
        $promotion = $this->makePromotion();
        $this->response = $this->json('DELETE', '/api/promotions/'.$promotion->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/promotions/'.$promotion->id);

        $this->response->assertStatus(404);
    }
}
