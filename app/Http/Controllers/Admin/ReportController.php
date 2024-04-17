<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Admin\OrderController;
use DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function orderReoprt()
    {
        $orderController = new OrderController();
        $paymentMethod = $orderController->paymentMethodCount();
        $recentOrders = $orderController->recentOrders();
        $monthlyOrderCount = $this->monthlyOrderCount();
        $topOrderTotal = $this->topOrderTotal();
        $totalOrderStatus = $this->orderStatusCount();
        return view(
            'admin.report.order',
            compact(
                'monthlyOrderCount',
                'paymentMethod',
                'recentOrders',
                'topOrderTotal',
                'totalOrderStatus'
            )
        );
    }
    public function productReoprt()
    {
        $top5SoldProducts = $this->top5SoldProducts();
        $worst5SoldProducts = $this->worst5SoldProducts();
        return view(
            'admin.report.product'
            ,
            compact(
                'top5SoldProducts',
                'worst5SoldProducts',
            )
        );
    }

    public function salesReoprt()
    {
        $orderController = new OrderController();
        $monthlySales = $orderController->monthlySalesReport();
        $paymentMethod = $orderController->paymentMethodCount();
        $recentOrders = $orderController->recentOrders();
        $recentPayment = $this->recentPayment();
        // dd($recentPayment);
        return view(
            'admin.report.sales'
            ,
            compact(
                'monthlySales',
                'paymentMethod',
                'recentOrders',
                'recentPayment'
            )
        );
    }

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

    // get top 5 highest order total
    public function topOrderTotal()
    {
        $topOrderTotal = Order::select('orders.id', 'total') // Specify 'orders.id' instead of just 'id'
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->orderBy('total', 'desc')
            ->select('orders.id', 'total', 'users.name')
            ->limit(5)
            ->get();

        return $topOrderTotal;
    }

    // get top 5 most sold products
    public function topSoldProducts()
    {
        $topSoldProducts = Order::select('product_id', 'products.name', 'products.price', 'products.image', 'products.category_id', 'categories.name as category_name', 'categories.slug as category_slug', 'categories.image as category_image', 'categories.parent_id as category_parent_id', 'categories.created_at as category_created_at', 'categories.updated_at as category_updated_at', 'categories.deleted_at as category_deleted_at', 'products.created_at as product_created_at', 'products.updated_at as product_updated_at', 'products.deleted_at as product_deleted_at', 'products.slug as product_slug')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('SUM(order_items.quantity) as quantity')
            ->groupBy('product_id')
            ->orderBy('quantity', 'desc')
            ->limit(5)
            ->get();

        return $topSoldProducts;
    }

    // get top 5 most sold products
    public function top5SoldProducts()
    {
        $topSoldProducts = OrderDetail::select(
            'product_id',
            DB::raw('MAX(products.name) as name'),
            DB::raw('MAX(products.price) as price'),
            DB::raw('MAX(products.image) as image'),
        )
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->selectRaw('SUM(order_details.quantity) as quantity')
            ->groupBy('product_id')
            ->orderBy('quantity', 'desc')
            ->limit(5)
            ->get();

        return $topSoldProducts;
    }

    // get worst 5 most sold products
    public function worst5SoldProducts()
    {
        $worstSoldProducts = OrderDetail::select(
            'product_id',
            DB::raw('MAX(products.name) as name'),
            DB::raw('MAX(products.price) as price'),
            DB::raw('MAX(products.image) as image'),
        )
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->selectRaw('SUM(order_details.quantity) as quantity')
            ->groupBy('product_id')
            ->orderBy('quantity', 'asc')
            ->limit(5)
            ->get();


        return $worstSoldProducts;
    }


    // get total number od order status
    public function orderStatusCount()
    {
        $totalOrderStatus = Order::select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        $data = [
            'total' => Order::count()
        ];
        foreach ($totalOrderStatus as $status) {
            $data[$status->status] = $status->count;
        }

        return $data;
    }

    // recent payment
    // join table paymernt with order
    public function recentPayment()
    {
        $recentPayment = DB::table('payments')
            ->join('orders', 'payments.order_id', '=', 'orders.id')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->select('payments.*', 'orders.total', 'orders.created_at', 'users.name')
            ->orderBy('payments.created_at', 'desc')
            ->limit(5)
            ->get();

        return $recentPayment;
    }




}
