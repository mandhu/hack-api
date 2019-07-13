<?php

namespace App\Http\Controllers\API;

use App\Events\NewTransaction;
use App\Http\Requests\API\CreatePromotionAPIRequest;
use App\Http\Requests\API\UpdatePromotionAPIRequest;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use App\Repositories\RefundRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RefundAPIController
 * @package App\Http\Controllers\API
 */

class RefundAPIController extends AppBaseController
{
    /** @var  RefundRepository */
    private $refundRepository;

    public function __construct(RefundRepository $refundRepository)
    {
        $this->refundRepository = $refundRepository;
    }

    public function store(CreatePromotionAPIRequest $request)
    {
        $input = $request->all();

        $refund = $this->refundRepository->create($input);

        event(new NewTransaction($refund));

        return $this->sendResponse($refund->toArray(), 'Refund saved successfully');
    }
}
