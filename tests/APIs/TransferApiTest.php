<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTransferTrait;
use Tests\ApiTestTrait;

class TransferApiTest extends TestCase
{
    use MakeTransferTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transfer()
    {
        $transfer = $this->fakeTransferData();
        $this->response = $this->json('POST', '/api/transfers', $transfer);

        $this->assertApiResponse($transfer);
    }

    /**
     * @test
     */
    public function test_read_transfer()
    {
        $transfer = $this->makeTransfer();
        $this->response = $this->json('GET', '/api/transfers/'.$transfer->id);

        $this->assertApiResponse($transfer->toArray());
    }

    /**
     * @test
     */
    public function test_update_transfer()
    {
        $transfer = $this->makeTransfer();
        $editedTransfer = $this->fakeTransferData();

        $this->response = $this->json('PUT', '/api/transfers/'.$transfer->id, $editedTransfer);

        $this->assertApiResponse($editedTransfer);
    }

    /**
     * @test
     */
    public function test_delete_transfer()
    {
        $transfer = $this->makeTransfer();
        $this->response = $this->json('DELETE', '/api/transfers/'.$transfer->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/transfers/'.$transfer->id);

        $this->response->assertStatus(404);
    }
}
