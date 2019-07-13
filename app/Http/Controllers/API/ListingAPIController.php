<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateListingAPIRequest;
use App\Http\Requests\API\UpdateListingAPIRequest;
use App\Models\Listing;
use App\Models\Promotion;
use App\Repositories\ListingRepository;
use App\Repositories\PromotionRepository;
use App\Traits\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ListingController
 * @package App\Http\Controllers\API
 */

class ListingAPIController extends AppBaseController
{
    use Auth;

    /** @var  ListingRepository */
    private $listingRepository;

    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(ListingRepository $listingRepo, PromotionRepository $promotionRepository)
    {
        $this->listingRepository = $listingRepo;
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the Listing.
     * GET|HEAD /listings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $listings = $this->listingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($listings->toArray(), 'Listings retrieved successfully');
    }

    /**
     * Store a newly created Listing in storage.
     * POST /listings
     *
     * @param CreateListingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateListingAPIRequest $request)
    {
        $input = $request->all();

        $input['seller_id'] = $this->getAuthUser(3);
        $input['status'] = 'Active';

        $listing = $this->listingRepository->create($input);

        if ($request->get('promote')) {
            $this->promotionRepository->promote($listing);
        }

        return $this->sendResponse($listing->toArray(), 'Listing saved successfully');
    }

    /**
     * Display the specified Listing.
     * GET|HEAD /listings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Listing $listing */
        $listing = $this->listingRepository->find($id);

        if (empty($listing)) {
            return $this->sendError('Listing not found');
        }

        return $this->sendResponse($listing->toArray(), 'Listing retrieved successfully');
    }

    /**
     * Update the specified Listing in storage.
     * PUT/PATCH /listings/{id}
     *
     * @param int $id
     * @param UpdateListingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateListingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Listing $listing */
        $listing = $this->listingRepository->find($id);

        if (empty($listing)) {
            return $this->sendError('Listing not found');
        }

        $listing = $this->listingRepository->update($input, $id);

        return $this->sendResponse($listing->toArray(), 'Listing updated successfully');
    }

    /**
     * Remove the specified Listing from storage.
     * DELETE /listings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Listing $listing */
        $listing = $this->listingRepository->find($id);

        if (empty($listing)) {
            return $this->sendError('Listing not found');
        }

        $listing->delete();

        return $this->sendResponse($id, 'Listing deleted successfully');
    }

    public function cancel($id)
    {
        /** @var Listing $listing */
        $listing = $this->listingRepository->find($id);

        if (empty($listing)) {
            return $this->sendError('Listing not found');
        }

        $listing->status = 'Cancelled';
        $listing->save();

        return $this->sendResponse($listing, 'Listing Cancelled');
    }
}