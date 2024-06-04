<?php

namespace App\Http\Controllers\Api;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Http\Resources\SellerResource;
use App\Http\Resources\ProductResource;

class SellerController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::with(['products', 'orderHeads'])->get();
        $data    = SellerResource::collection($sellers);

        return $this->successResponse('sellers list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $data     = ProductResource::collection($products);

        return $this->successResponse('create seller', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerRequest $request)
    {
        $seller = Seller::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        if ($seller){
            $seller->products()->attach($request->products);

            return $this->successResponse('The seller create successfully', []);
        }

        return $this->failedResponse('Error in create seller', 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seller = Seller::whereId($id)->with(['products', 'orderHeads'])->first();

        if ($seller){
            $data = new SellerResource($seller);

            return $this->successResponse('show seller', $data);
        }

        return $this->failedResponse('The seller not found', 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $seller = Seller::whereId($id)->with(['products'])->first();
        $products = Product::all();

        if ($seller){
            $sellerResource = new SellerResource($seller);
            $productResource = ProductResource::collection($products);

            $data = ['seller' => $sellerResource, 'products' => $productResource];

            return $this->successResponse('edit seller', $data);
        }

        return $this->failedResponse('The seller not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerRequest $request, string $id)
    {
        $seller = Seller::find($id);

        if ($seller){
            $result = $seller->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);

            if ($result){
                $seller->products()->sync($request->products);

                return $this->successResponse('The seller updated successfully', []);
            }

            return $this->failedResponse('Error in update seller', 401);
        }

        return $this->failedResponse('The seller not found', 404);
    }

}
