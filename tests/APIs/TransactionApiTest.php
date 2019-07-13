<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTransactionTrait;
use Tests\ApiTestTrait;

class TransactionApiTest extends TestCase
{
    use MakeTransactionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transaction()
    {
        $transaction = $this->fakeTransactionData();
        $this->response = $this->json('POST', '/api/transactions', $transaction);

        $this->assertApiResponse($transaction);
    }

    /**
     * @test
     */
    public function test_read_transaction()
    {
        $transaction = $this->makeTransaction();
        $this->response = $this->json('GET', '/api/transactions/'.$transaction->id);

        $this->assertApiResponse($transaction->toArray());
    }

    /**
     * @test
     */
    public function test_update_transaction()
    {
        $transaction = $this->makeTransaction();
        $editedTransaction = $this->fakeTransactionData();

        $this->response = $this->json('PUT', '/api/transactions/'.$transaction->id, $editedTransaction);

        $this->assertApiResponse($editedTransaction);
    }

    /**
     * @test
     */
    public function test_delete_transaction()
    {
        $transaction = $this->makeTransaction();
        $this->response = $this->json('DELETE', '/api/transactions/'.$transaction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/transactions/'.$transaction->id);

        $this->response->assertStatus(404);
    }
}
