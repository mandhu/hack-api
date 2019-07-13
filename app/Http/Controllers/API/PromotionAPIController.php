<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePromotionAPIRequest;
use App\Http\Requests\API\UpdatePromotionAPIRequest;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PromotionController
 * @package App\Http\Controllers\API
 */

class PromotionAPIController extends AppBaseController
{
    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(PromotionRepository $promotionRepo)
    {
        $this->promotionRepository = $promotionRepo;
    }

    /**
     * Display a listing of the Promotion.
     * GET|HEAD /promotions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $promotions = $this->promotionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($promotions->toArray(), 'Promotions retrieved successfully');
    }

    /**
     * Store a newly created Promotion in storage.
     * POST /promotions
     *
     * @param CreatePromotionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePromotionAPIRequest $request)
    {
        $input = $request->all();

        $promotion = $this->promotionRepository->create($input);

        return $this->sendResponse($promotion->toArray(), 'Promotion saved successfully');
    }

    /**
     * Display the specified Promotion.
     * GET|HEAD /promotions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->find($id);

        if (empty($promotion)) {
            return $this->sendError('Promotion not found');
        }

        return $this->sendResponse($promotion->toArray(), 'Promotion retrieved successfully');
    }

    /**
     * Update the specified Promotion in storage.
     * PUT/PATCH /promotions/{id}
     *
     * @param int $id
     * @param UpdatePromotionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromotionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->find($id);

        if (empty($promotion)) {
            return $this->sendError('Promotion not found');
        }

        $promotion = $this->promotionRepository->update($input, $id);

        return $this->sendResponse($promotion->toArray(), 'Promotion updated successfully');
    }

    /**
     * Remove the specified Promotion from storage.
     * DELETE /promotions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->find($id);

        if (empty($promotion)) {
            return $this->sendError('Promotion not found');
        }

        $promotion->delete();

        return $this->sendResponse($id, 'Promotion deleted successfully');
    }
}
