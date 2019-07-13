<?php namespace Tests\Repositories;

use App\Models\Transfer;
use App\Repositories\TransferRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTransferTrait;
use Tests\ApiTestTrait;

class TransferRepositoryTest extends TestCase
{
    use MakeTransferTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransferRepository
     */
    protected $transferRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transferRepo = \App::make(TransferRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transfer()
    {
        $transfer = $this->fakeTransferData();
        $createdTransfer = $this->transferRepo->create($transfer);
        $createdTransfer = $createdTransfer->toArray();
        $this->assertArrayHasKey('id', $createdTransfer);
        $this->assertNotNull($createdTransfer['id'], 'Created Transfer must have id specified');
        $this->assertNotNull(Transfer::find($createdTransfer['id']), 'Transfer with given id must be in DB');
        $this->assertModelData($transfer, $createdTransfer);
    }

    /**
     * @test read
     */
    public function test_read_transfer()
    {
        $transfer = $this->makeTransfer();
        $dbTransfer = $this->transferRepo->find($transfer->id);
        $dbTransfer = $dbTransfer->toArray();
        $this->assertModelData($transfer->toArray(), $dbTransfer);
    }

    /**
     * @test update
     */
    public function test_update_transfer()
    {
        $transfer = $this->makeTransfer();
        $fakeTransfer = $this->fakeTransferData();
        $updatedTransfer = $this->transferRepo->update($fakeTransfer, $transfer->id);
        $this->assertModelData($fakeTransfer, $updatedTransfer->toArray());
        $dbTransfer = $this->transferRepo->find($transfer->id);
        $this->assertModelData($fakeTransfer, $dbTransfer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transfer()
    {
        $transfer = $this->makeTransfer();
        $resp = $this->transferRepo->delete($transfer->id);
        $this->assertTrue($resp);
        $this->assertNull(Transfer::find($transfer->id), 'Transfer should not exist in DB');
    }
}
