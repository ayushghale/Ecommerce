<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // new order list
    public function newOrder()
    {
        $orderData = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->where('orders.status', 'pending')
            ->get();

        $finalOrderData = [];

        foreach ($orderData as $order) {

            $orderDetails = OrderDetail::join('products', 'products.id', '=', 'order_details.product_id')
                ->where('order_details.order_id', $order->id)
                ->get();

            $a = [];

            foreach ($orderDetails as $orderDetail) {
                $a[] = [
                    'productName' => $orderDetail->name,
                    'productPrice' => $orderDetail->price,
                    'productQuantity' => $orderDetail->quantity,
                    'productSubTotal' => ($orderDetail->price * $orderDetail->quantity)
                ];
            }
            $finalOrderData[] = [
                'orderId' => $order->id,
                'orderDate' => $order->created_at->format('Y-m-d'),
                'orderStatus' => $order->status,
                'orderTotal' => $order->total,
                'PaymentMethod' => $order->payment_method,
                'PaymentStatus' => $order->payment_status,
                'PaymentDate' => $order->created_at->format('Y-m-d'),
                'PaymentAmount' => $order->payment_amount,
                'PaymentRef' => $order->payment_ref,
                'User' => $order->name,
                'UserEmail' => $order->email,
                'UserPhone' => $order->contact_number,
                'UserAddress' => $order->location,
                'orderDetails' => $a
            ];
        }


        return view('admin.order.newOrder', compact('finalOrderData'));
    }

    public function completedOrder()
    {
        $orderData = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->get();

        $finalOrderData = [];

        foreach ($orderData as $order) {

            $orderDetails = OrderDetail::join('products', 'products.id', '=', 'order_details.product_id')
                ->where('order_details.order_id', $order->id)
                ->get();

            $a = [];

            foreach ($orderDetails as $orderDetail) {
                $a[] = [
                    'productName' => $orderDetail->name,
                    'productPrice' => $orderDetail->price,
                    'productQuantity' => $orderDetail->quantity,
                    'productSubTotal' => ($orderDetail->price * $orderDetail->quantity)
                ];
            }
            $finalOrderData[] = [
                'orderId' => $order->id,
                'orderDate' => $order->created_at->format('Y-m-d'),
                'orderStatus' => $order->status,
                'orderTotal' => $order->total,
                'PaymentMethod' => $order->payment_method,
                'PaymentStatus' => $order->payment_status,
                'PaymentDate' => $order->created_at->format('Y-m-d'),
                'PaymentAmount' => $order->payment_amount,
                'PaymentRef' => $order->payment_ref,
                'User' => $order->name,
                'UserEmail' => $order->email,
                'UserPhone' => $order->contact_number,
                'UserAddress' => $order->location,
                'orderDetails' => $a
            ];
        }
        return view('admin.order.completedOrder', compact('finalOrderData'));
    }

    // view order details
    public function viewOrder($id)
    {
        $orderData = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->where('orders.id', $id)
            ->get();

        $finalOrderData = [];

        foreach ($orderData as $order) {

            $orderDetails = OrderDetail::join('products', 'products.id', '=', 'order_details.product_id')
                ->where('order_details.order_id', $order->id)
                ->get();

            $a = [];

            foreach ($orderDetails as $orderDetail) {
                $a[] = [
                    'productName' => $orderDetail->name,
                    'productPrice' => $orderDetail->price,
                    'productQuantity' => $orderDetail->quantity,
                    'productImage' => $orderDetail->image,
                    'productSubTotal' => ($orderDetail->price * $orderDetail->quantity)
                ];
            }
            $finalOrderData[] = [
                'orderId' => $order->id,
                'orderDate' => $order->created_at->format('Y-m-d'),
                'orderStatus' => $order->status,
                'orderTotal' => $order->total,
                'PaymentMethod' => $order->payment_method,
                'PaymentStatus' => $order->payment_status,
                'PaymentDate' => $order->created_at->format('Y-m-d'),
                'PaymentAmount' => $order->payment_amount,
                'PaymentRef' => $order->payment_ref,
                'User' => $order->name,
                'UserEmail' => $order->email,
                'UserPhone' => $order->contact_number,
                'UserAddress' => $order->location,
                'orderDetails' => $a
            ];
        }

        return view('admin.order.viewOrder', compact('finalOrderData'));
    }

    // update order status
    public function updateOrderStatus(Request $request, $id)
    {
        try {
            if ($request->paymentStatus) {
                $payment = Payment::where('order_id', $id)->first();
                $payment->payment_status = $request->paymentStatus;
                $payment->save();
            }
            $paymnetStatus = Payment::where('order_id', ($id))->first();
            if ($paymnetStatus->payment_status == "pending") {
                return redirect()->back()->with('error', 'Please update payment status first');
            } else {
                $order = Order::find($id);
                $order->status = $request->orderStatus;
                $order->save();
            }


            return redirect()->back()->with('success', 'Order status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }



    // get recet new 5 orders
    public function recentOrders()
    {
        $orderData = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('payments', 'payments.order_id', '=', 'orders.id')
            ->orderBy('orders.created_at', 'desc')
            ->limit(5)
            ->get();

        $finalOrderData = [];

        foreach ($orderData as $order) {

            $orderDetails = OrderDetail::join('products', 'products.id', '=', 'order_details.product_id')
                ->where('order_details.order_id', $order->id)
                ->get();

            $a = [];

            foreach ($orderDetails as $orderDetail) {
                $a[] = [
                    'productName' => $orderDetail->name,
                    'productPrice' => $orderDetail->price,
                    'productQuantity' => $orderDetail->quantity,
                    'productSubTotal' => ($orderDetail->price * $orderDetail->quantity)
                ];
            }
            $finalOrderData[] = [
                'orderId' => $order->id,
                'orderDate' => $order->created_at->format('Y-m-d'),
                'orderStatus' => $order->status,
                'orderTotal' => $order->total,
                'PaymentMethod' => $order->payment_method,
                'PaymentStatus' => $order->payment_status,
                'PaymentDate' => $order->created_at->format('Y-m-d'),
                'PaymentAmount' => $order->payment_amount,
                'PaymentRef' => $order->payment_ref,
                'User' => $order->name,
                'UserEmail' => $order->email,
                'UserPhone' => $order->contact_number,
                'UserAddress' => $order->location,
                'orderDetails' => $a
            ];
        }
        return $finalOrderData;
    }

    // get monthly sales report of the year till the current month
    public function monthlySalesReport()
    {
        // Get the current month
        $currentMonth = date('n');

        // Get monthly sales data from the database up to the current month
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', date('Y'))
            ->whereRaw('MONTH(created_at) <= ?', [$currentMonth])
            ->groupBy('month')
            ->get();

        // Initialize an array containing month names and corresponding sales totals
        $monthlySalesData = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Fill in sales data for months with sales
        foreach ($monthlySales as $monthlySale) {
            $monthlySalesData[$monthlySale->month] = [
                'month' => $monthNames[$monthlySale->month - 1],
                'total' => $monthlySale->total
            ];
        }

        // Fill in sales data for months with no sales (totals = 0)
        for ($month = 1; $month <= $currentMonth; $month++) {
            if (!isset($monthlySalesData[$month])) {
                $monthlySalesData[$month] = [
                    'month' => $monthNames[$month - 1],
                    'total' => 0
                ];
            }
        }

        // Sort the data by month number
        ksort($monthlySalesData);

        // Return the merged sales data
        return array_values($monthlySalesData); // Reset array keys
    }

    // get total number of paymnent methods used and count
    public function paymentMethodCount()
    {
        $payment = Payment::select('payment_method', \DB::raw('COUNT(payment_method) as count'))
            ->groupBy('payment_method')
            ->get();

        $paymentMethods = [];
        foreach ($payment as $pay) {
            $paymentMethods[] = [
                'paymentMethod' => $pay->payment_method,
                'count' => $pay->count
            ];
        }

        return $paymentMethods;
    }

    // get monthly order count of the year till the current month
    public function monthlyOrderCount()
    {
        // Get the current month
        $currentMonth = date('n');

        // Get monthly order count data from the database up to the current month
        $monthlyOrderCount = Order::selectRaw('MONTH(created_at) as month, COUNT(id) as count')
            ->whereYear('created_at', date('Y'))
            ->whereRaw('MONTH(created_at) <= ?', [$currentMonth])
            ->groupBy('month')
            ->get();

        // Initialize an array containing month names and corresponding order counts
        $monthlyOrderCountData = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Fill in order count data for months with orders
        foreach ($monthlyOrderCount as $monthlyOrder) {
            $monthlyOrderCountData[$monthlyOrder->month] = [
                'month' => $monthNames[$monthlyOrder->month - 1],
                'count' => $monthlyOrder->count
            ];
        }

        // Fill in order count data for months with no orders (counts = 0)
        for ($month = 1; $month <= $currentMonth; $month++) {
            if (!isset($monthlyOrderCountData[$month])) {
                $monthlyOrderCountData[$month] = [
                    'month' => $monthNames[$month - 1],
                    'count' => 0
                ];
            }
        }

        // Sort the data by month number
        ksort($monthlyOrderCountData);

        // Return the merged order count data
        return array_values($monthlyOrderCountData); // Reset array keys
    }


}
