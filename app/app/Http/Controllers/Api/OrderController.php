<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\OrderHead;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ResponseTrait;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\OrderHeadTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\OrderHeadResource;


class OrderController extends Controller
{
    use ResponseTrait, OrderTrait, OrderHeadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->query('uuid');

        if ($id !== null)
        {
            $seller           = Seller::find($id);
            $products         = $seller->products()->orderByDesc('name')->get();
            $productsResource = ProductResource::collection($products);

            $data = ['seller_id' => $id, 'products' => $productsResource];

            return $this->successResponse('Create order', $data);
        }

        return $this->failedResponse('The seller not found', 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $orderHead = $this->createOrderHead($request);
        $totalPrice = 0;

        foreach($request->products as $productArray)
        {
            $order = $this->createOrder($orderHead->id, $productArray);
            $totalPrice += $order->total_price;
        }

        $orderHead->total_price = $totalPrice;
        $orderHead->save();
        $orderHead->load('orders');

        $data = new OrderHeadResource($orderHead);

        return $this->successResponse('Order created successfully', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderHead = OrderHead::whereId($id)->with(['orders.product', 'seller', 'user'])->first();

        if ($orderHead){
            $data = new OrderHeadResource($orderHead);

            return $this->successResponse('show order', $data);
        }

        return $this->failedResponse('The order not found', 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function createUrl(Request $request)
    {
        $request->validate([
            'mobile' => ['required','regex:/^(\+98|0|0098)?9\d{9}$/i', 'exists:sellers,mobile']
        ]);

        $seller = Seller::whereMobile($request->mobile)->first();
        if ($seller){
            $data = env('APP_URL')."api/order/create?uuid=$seller->id";

            return $this->successResponse('create order', $data);
        }

        return $this->failedResponse('The seller not found', 404);
    }

}
