<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return new PaymentResource($payments, 'Success', 'List of payments');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'status' => 'required|in:pending,completed,failed',
        ]);

        if ($validator->fails()) {
            return new PaymentResource(null, 'Failed', $validator->errors());
        }

        $orderResponse = Http::get('http://127.0.0.1:8002/api/order/' . $request->order_id);

        if ($orderResponse->failed()) {
            return new PaymentResource(null, 'Failed', 'Order not found');
        }

        $payment = Payment::create($request->all());

        return new PaymentResource($payment, 'Success', 'Payment created successfully');
    }


    public function show($id)
    {
        $payment = Payment::find($id);
        if ($payment) {
            return new PaymentResource($payment, 'Success', 'Payment found');
        } else {
            return new PaymentResource(null, 'Failed', 'Payment not found');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'status' => 'required|in:pending,completed,failed',
        ]);

        if ($validator->fails()) {
            return new PaymentResource(null, 'Failed', $validator->errors());
        }

        $payment = Payment::find($id);

        if (!$payment) {
            return new PaymentResource(null, 'Failed', 'Payment not found');
        }

        $orderResponse = Http::get('http://127.0.0.1:8002/api/order/' . $request->order_id);

        if ($orderResponse->failed()) {
            return new PaymentResource(null, 'Failed', 'Order not found');
        }

        $payment->update([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        return new PaymentResource($payment, 'Success', 'Payment updated successfully');
    }


    public function destroy($id)
    {
        $payment = Payment::find($id);
        if ($payment) {
            $payment->delete();
            return new PaymentResource($payment, 'Success', 'Payment deleted successfully');
        } else {
            return new PaymentResource(null, 'Failed', 'Payment not found');
        }
    }
}
