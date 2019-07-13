<?php namespace Tests\Repositories;

use App\Models\ProductName;
use App\Repositories\ProductNameRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProductNameTrait;
use Tests\ApiTestTrait;

class ProductNameRepositoryTest extends TestCase
{
    use MakeProductNameTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductNameRepository
     */
    protected $productNameRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productNameRepo = \App::make(ProductNameRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_name()
    {
        $productName = $this->fakeProductNameData();
        $createdProductName = $this->productNameRepo->create($productName);
        $createdProductName = $createdProductName->toArray();
        $this->assertArrayHasKey('id', $createdProductName);
        $this->assertNotNull($createdProductName['id'], 'Created ProductName must have id specified');
        $this->assertNotNull(ProductName::find($createdProductName['id']), 'ProductName with given id must be in DB');
        $this->assertModelData($productName, $createdProductName);
    }

    /**
     * @test read
     */
    public function test_read_product_name()
    {
        $productName = $this->makeProductName();
        $dbProductName = $this->productNameRepo->find($productName->id);
        $dbProductName = $dbProductName->toArray();
        $this->assertModelData($productName->toArray(), $dbProductName);
    }

    /**
     * @test update
     */
    public function test_update_product_name()
    {
        $productName = $this->makeProductName();
        $fakeProductName = $this->fakeProductNameData();
        $updatedProductName = $this->productNameRepo->update($fakeProductName, $productName->id);
        $this->assertModelData($fakeProductName, $updatedProductName->toArray());
        $dbProductName = $this->productNameRepo->find($productName->id);
        $this->assertModelData($fakeProductName, $dbProductName->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_name()
    {
        $productName = $this->makeProductName();
        $resp = $this->productNameRepo->delete($productName->id);
        $this->assertTrue($resp);
        $this->assertNull(ProductName::find($productName->id), 'ProductName should not exist in DB');
    }
}
