<?php

namespace App\Http\Controllers\API;

use App\Events\NewTransaction;
use App\Http\Requests\API\CreateTransferAPIRequest;
use App\Http\Requests\API\UpdateTransferAPIRequest;
use App\Models\Transfer;
use App\Repositories\TransferRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransferController
 * @package App\Http\Controllers\API
 */

class TransferAPIController extends AppBaseController
{
    /** @var  TransferRepository */
    private $transferRepository;

    public function __construct(TransferRepository $transferRepo)
    {
        $this->transferRepository = $transferRepo;
    }

    /**
     * Display a listing of the Transfer.
     * GET|HEAD /transfers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $transfers = $this->transferRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($transfers->toArray(), 'Transfers retrieved successfully');
    }

    /**
     * Store a newly created Transfer in storage.
     * POST /transfers
     *
     * @param CreateTransferAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTransferAPIRequest $request)
    {
        $input = $request->all();

        $transfer = $this->transferRepository->create($input);

        event(New NewTransaction($transfer));

        return $this->sendResponse($transfer->toArray(), 'Transfer saved successfully');
    }

    /**
     * Display the specified Transfer.
     * GET|HEAD /transfers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id);

        if (empty($transfer)) {
            return $this->sendError('Transfer not found');
        }

        return $this->sendResponse($transfer->toArray(), 'Transfer retrieved successfully');
    }

    /**
     * Update the specified Transfer in storage.
     * PUT/PATCH /transfers/{id}
     *
     * @param int $id
     * @param UpdateTransferAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransferAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id);

        if (empty($transfer)) {
            return $this->sendError('Transfer not found');
        }

        $transfer = $this->transferRepository->update($input, $id);

        return $this->sendResponse($transfer->toArray(), 'Transfer updated successfully');
    }

    /**
     * Remove the specified Transfer from storage.
     * DELETE /transfers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id);

        if (empty($transfer)) {
            return $this->sendError('Transfer not found');
        }

        $transfer->delete();

        return $this->sendResponse($id, 'Transfer deleted successfully');
    }
}
