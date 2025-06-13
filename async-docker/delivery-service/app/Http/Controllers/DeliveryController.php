<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();
        return new DeliveryResource($deliveries, 'Success', 'List of deliveries');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'delivery_address' => 'required|string',
            'status' => 'required|in:in_transit,delivered,pending',
            'delivery_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return new DeliveryResource(null, 'Failed', $validator->errors());
        }

        $orderResponse = Http::get('http://127.0.0.1:8002/api/order/' . $request->order_id);

        if ($orderResponse->failed()) {
            return new DeliveryResource(null, 'Failed', 'Order not found');
        }

        $delivery = Delivery::create($request->all());

        return new DeliveryResource($delivery, 'Success', 'Delivery created successfully');
    }

    public function show($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery) {
            return new DeliveryResource($delivery, 'Success', 'Delivery found');
        } else {
            return new DeliveryResource(null, 'Failed', 'Delivery not found');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'delivery_address' => 'required|string',
            'status' => 'required|in:in_transit,delivered,pending',
            'delivery_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return new DeliveryResource(null, 'Failed', $validator->errors());
        }

        $delivery = Delivery::find($id);

        if (!$delivery) {
            return new DeliveryResource(null, 'Failed', 'Delivery not found');
        }

        $orderResponse = Http::get('http://127.0.0.1:8002/api/order/' . $request->order_id);

        if ($orderResponse->failed()) {
            return new DeliveryResource(null, 'Failed', 'Order not found');
        }

        $delivery->update([
            'order_id' => $request->order_id,
            'delivery_address' => $request->delivery_address,
            'status' => $request->status,
            'delivery_date' => $request->delivery_date,
        ]);

        return new DeliveryResource($delivery, 'Success', 'Delivery updated successfully');
    }

    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery) {
            $delivery->delete();
            return new DeliveryResource($delivery, 'Success', 'Delivery deleted successfully');
        } else {
            return new DeliveryResource(null, 'Failed', 'Delivery not found');
        }
    }
}
