<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return new OrderResource($orders, 'Success', 'List of orders');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'menu_item_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return new OrderResource(null, 'Failed', $validator->errors());
        }

        $menuResponse = Http::post('http://127.0.0.1:8001/menu-graphql', [
            'query' => '
            query {
                getMenuItem(id: ' . $request->menu_item_id . ') {
                    price
                }
            }
        '
        ]);

        if ($menuResponse->failed() || !$menuResponse->ok() || !isset($menuResponse['data']['getMenuItem']['price'])) {
            return new OrderResource(null, 'Failed', 'Failed to retrieve menu item price');
        }

        $price = $menuResponse['data']['getMenuItem']['price'];

        if (!is_numeric($price) || $price <= 0) {
            return new OrderResource(null, 'Failed', 'Invalid menu item price');
        }

        $totalPrice = $price * $request->quantity;

        $order = Order::create([
            'user_id' => $request->user_id,
            'menu_item_id' => $request->menu_item_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'total_price' => $totalPrice,
        ]);

        event(new OrderCreated($order));

        return new OrderResource($order, 'Success', 'Order created successfully');
    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return new OrderResource($order, 'Success', 'Order found');
        } else {
            return new OrderResource(null, 'Failed', 'Order not found');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'menu_item_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return new OrderResource(null, 'Failed', $validator->errors());
        }

        $order = Order::find($id);

        if (!$order) {
            return new OrderResource(null, 'Failed', 'Order not found');
        }

        $menuResponse = Http::post('http://127.0.0.1:8001/menu-graphql', [
            'query' => '
            query {
                getMenuItem(id: ' . $request->menu_item_id . ') {
                    price
                }
            }
        '
        ]);

        if ($menuResponse->failed() || !$menuResponse->ok() || !isset($menuResponse['data']['getMenuItem']['price'])) {
            return new OrderResource(null, 'Failed', 'Failed to retrieve menu item price');
        }

        $price = $menuResponse['data']['getMenuItem']['price'];

        if (!is_numeric($price) || $price <= 0) {
            return new OrderResource(null, 'Failed', 'Invalid menu item price');
        }

        $totalPrice = $price * $request->quantity;

        $order->update([
            'user_id' => $request->user_id,
            'menu_item_id' => $request->menu_item_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'total_price' => $totalPrice,
        ]);

        return new OrderResource($order, 'Success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return new OrderResource($order, 'Success', 'Order deleted successfully');
        } else {
            return new OrderResource(null, 'Failed', 'Order not found');
        }
    }
}
