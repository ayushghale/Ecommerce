<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paymentData()
    {
        $payment = Payment::all();
        return response()->json([
            'success' => true,
            'message' => 'Payment found',
            'data' => $payment
        ], 200);
    }

    /**
     * Show  payment data by user id and payment_status
     */
    public function showPaymentByUserId($id, $payment_status)
    {
        $payment = Payment::where('user_id', $id)->where('payment_status', $payment_status)->get();
        return response()->json([
            'success' => true,
            'message' => 'Payment found',
            'data' => $payment
        ], 200);
    }

    /**
     * Show  payment data by their id.
     */
    public function showPaymentById($id)
    {
        $payment = Payment::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Payment found',
            'data' => $payment
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store($order_id,$user_id, $payment_method, $total)
    {
        if ($order_id == null) {
            return response()->json([
                'success' => false,
                'message' => 'Order details already exist',
            ], 400);
        } else {
            $payment = new Payment();
            $payment->order_id = $order_id;
            $payment->user_id = $user_id;
            $payment->payment_method = $payment_method;
            $payment->payment_amount = $total;
            $payment->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment created',
                'data' => $payment,
            ], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment, $id)
    {
        $validate = Validator::make($request->all(), [
            'transactionCode' => 'required|string',
            'payment_status' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validate->errors()
            ], 400);
        } else {
            $payment = Payment::find($id);
            $payment->transactionCode = $request->transactionCode;
            $payment->payment_status = $request->payment_status;
            $payment->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment updated',
                'data' => $payment
            ], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
