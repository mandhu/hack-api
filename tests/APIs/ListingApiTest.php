<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeListingTrait;
use Tests\ApiTestTrait;

class ListingApiTest extends TestCase
{
    use MakeListingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_listing()
    {
        $listing = $this->fakeListingData();
        $this->response = $this->json('POST', '/api/listings', $listing);

        $this->assertApiResponse($listing);
    }

    /**
     * @test
     */
    public function test_read_listing()
    {
        $listing = $this->makeListing();
        $this->response = $this->json('GET', '/api/listings/'.$listing->id);

        $this->assertApiResponse($listing->toArray());
    }

    /**
     * @test
     */
    public function test_update_listing()
    {
        $listing = $this->makeListing();
        $editedListing = $this->fakeListingData();

        $this->response = $this->json('PUT', '/api/listings/'.$listing->id, $editedListing);

        $this->assertApiResponse($editedListing);
    }

    /**
     * @test
     */
    public function test_delete_listing()
    {
        $listing = $this->makeListing();
        $this->response = $this->json('DELETE', '/api/listings/'.$listing->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/listings/'.$listing->id);

        $this->response->assertStatus(404);
    }
}
