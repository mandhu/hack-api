<?php namespace Tests\Repositories;

use App\Models\Listing;
use App\Repositories\ListingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeListingTrait;
use Tests\ApiTestTrait;

class ListingRepositoryTest extends TestCase
{
    use MakeListingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ListingRepository
     */
    protected $listingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->listingRepo = \App::make(ListingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_listing()
    {
        $listing = $this->fakeListingData();
        $createdListing = $this->listingRepo->create($listing);
        $createdListing = $createdListing->toArray();
        $this->assertArrayHasKey('id', $createdListing);
        $this->assertNotNull($createdListing['id'], 'Created Listing must have id specified');
        $this->assertNotNull(Listing::find($createdListing['id']), 'Listing with given id must be in DB');
        $this->assertModelData($listing, $createdListing);
    }

    /**
     * @test read
     */
    public function test_read_listing()
    {
        $listing = $this->makeListing();
        $dbListing = $this->listingRepo->find($listing->id);
        $dbListing = $dbListing->toArray();
        $this->assertModelData($listing->toArray(), $dbListing);
    }

    /**
     * @test update
     */
    public function test_update_listing()
    {
        $listing = $this->makeListing();
        $fakeListing = $this->fakeListingData();
        $updatedListing = $this->listingRepo->update($fakeListing, $listing->id);
        $this->assertModelData($fakeListing, $updatedListing->toArray());
        $dbListing = $this->listingRepo->find($listing->id);
        $this->assertModelData($fakeListing, $dbListing->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_listing()
    {
        $listing = $this->makeListing();
        $resp = $this->listingRepo->delete($listing->id);
        $this->assertTrue($resp);
        $this->assertNull(Listing::find($listing->id), 'Listing should not exist in DB');
    }
}
