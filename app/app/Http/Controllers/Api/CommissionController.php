<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\CommissionRequest;
use App\Http\Resources\CommissionResource;

class CommissionController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commissions = Commission::with('product')->orderByDesc('id')->get();
        $data        = CommissionResource::collection($commissions);

        return $this->successResponse('commissions list', $data);
    }

    public function create()
    {
        $products = Product::orderByDesc('id')->get();
        $data     = ProductResource::collection($products);

        return $this->successResponse('create commission', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CommissionRequest $request)
    {
        $commission = Commission::create([
            'product_id' => $request->product_id,
            'min' => $request->min,
            'max' => $request->max,
            'percent' => $request->percent / 100,
        ]);

        if ($commission){

            return $this->successResponse('The commission created successfully', []);
        }

        return $this->failedResponse('Error in create commission', 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commission = Commission::find($id);

        if ($commission)
        {
            $data = new CommissionResource($commission);

            return $this->successResponse('show commission', $data);
        }

        return $this->failedResponse('The commission not found', 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commission = Commission::find($id);

        if ($commission)
        {
            $commission->load('product');
            $commissionResource = new CommissionResource($commission);
            $products = Product::orderByDesc('id')->get();
            $productsResource = ProductResource::collection($products);
            $data     = ['commission' => $commissionResource, 'products' => $productsResource];

            return $this->successResponse('edit commission', $data);
        }

        return $this->failedResponse('The commission not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommissionRequest $request, string $id)
    {
        $commission = Commission::find($id);

        if ($commission)
        {
            $commission->update([
                'product_id' => $request->product_id,
                'min' => $request->min,
                'max' => $request->max,
                'percent' => $request->percent / 100,
            ]);

            return $this->successResponse('The commission updated successfully', []);
        }

        return $this->failedResponse('The commission not found', 404);
    }

}
