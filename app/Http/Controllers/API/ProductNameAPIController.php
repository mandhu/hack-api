<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductNameAPIRequest;
use App\Http\Requests\API\UpdateProductNameAPIRequest;
use App\Models\ProductName;
use App\Repositories\ProductNameRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductNameController
 * @package App\Http\Controllers\API
 */

class ProductNameAPIController extends AppBaseController
{
    /** @var  ProductNameRepository */
    private $productNameRepository;

    public function __construct(ProductNameRepository $productNameRepo)
    {
        $this->productNameRepository = $productNameRepo;
    }

    /**
     * Display a listing of the ProductName.
     * GET|HEAD /productNames
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productNames = $this->productNameRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productNames->toArray(), 'Product Names retrieved successfully');
    }

    /**
     * Store a newly created ProductName in storage.
     * POST /productNames
     *
     * @param CreateProductNameAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductNameAPIRequest $request)
    {
        $input = $request->all();

        $productName = $this->productNameRepository->create($input);

        return $this->sendResponse($productName->toArray(), 'Product Name saved successfully');
    }

    /**
     * Display the specified ProductName.
     * GET|HEAD /productNames/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductName $productName */
        $productName = $this->productNameRepository->find($id);

        if (empty($productName)) {
            return $this->sendError('Product Name not found');
        }

        return $this->sendResponse($productName->toArray(), 'Product Name retrieved successfully');
    }

    /**
     * Update the specified ProductName in storage.
     * PUT/PATCH /productNames/{id}
     *
     * @param int $id
     * @param UpdateProductNameAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductNameAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductName $productName */
        $productName = $this->productNameRepository->find($id);

        if (empty($productName)) {
            return $this->sendError('Product Name not found');
        }

        $productName = $this->productNameRepository->update($input, $id);

        return $this->sendResponse($productName->toArray(), 'ProductName updated successfully');
    }

    /**
     * Remove the specified ProductName from storage.
     * DELETE /productNames/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductName $productName */
        $productName = $this->productNameRepository->find($id);

        if (empty($productName)) {
            return $this->sendError('Product Name not found');
        }

        $productName->delete();

        return $this->sendResponse($id, 'Product Name deleted successfully');
    }
}
