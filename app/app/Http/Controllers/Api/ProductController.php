<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['sellers', 'commissions'])->get();
        $data = ProductResource::collection($products);

        return $this->successResponse('products list', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        if ($product){

            return $this->successResponse('The product created successfully', []);
        }

        return $this->failedResponse('Error in create product', 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::whereId($id)->with(['sellers', 'commissions'])->first();

        if ($product){
            $data = new ProductResource($product);

            return $this->successResponse('show product', $data);
        }

        return $this->failedResponse('The product not found', 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if ($product){
            $product->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            $data = new ProductResource($product);

            return $this->successResponse('The product updated successfully', $data);
        }

        return $this->failedResponse('The product not found', 404);
    }

}
