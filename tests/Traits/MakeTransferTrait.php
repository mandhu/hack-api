<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Transfer;
use App\Repositories\TransferRepository;

trait MakeTransferTrait
{
    /**
     * Create fake instance of Transfer and save it in database
     *
     * @param array $transferFields
     * @return Transfer
     */
    public function makeTransfer($transferFields = [])
    {
        /** @var TransferRepository $transferRepo */
        $transferRepo = \App::make(TransferRepository::class);
        $theme = $this->fakeTransferData($transferFields);
        return $transferRepo->create($theme);
    }

    /**
     * Get fake instance of Transfer
     *
     * @param array $transferFields
     * @return Transfer
     */
    public function fakeTransfer($transferFields = [])
    {
        return new Transfer($this->fakeTransferData($transferFields));
    }

    /**
     * Get fake data of Transfer
     *
     * @param array $transferFields
     * @return array
     */
    public function fakeTransferData($transferFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'amount' => $fake->word,
            'type' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $transferFields);
    }
}
