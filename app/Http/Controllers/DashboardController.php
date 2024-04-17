<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OrderController;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $orderController = new OrderController();
        $monthlySales = $orderController->monthlySalesReport();
        $paymentMethod = $orderController->paymentMethodCount();
        $recentOrders = $orderController->recentOrders();
        $totalOrder = Order::count();
        $totalSales = Order::sum('total');
        $totalUsers = User::count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('monthlySales', 'paymentMethod', 'recentOrders', 'totalOrder', 'totalSales', 'totalUsers', 'totalProducts'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email || exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if ($user->role == 1) {

            if ($request->email == $user->email && \Hash::check($request->password, $user->password)) {
                $request->session()->put('adminLogin', $user->id);
                return redirect()->intended('admin/dashboard');
            } else {
                return back()->withErrors([
                    'error' => 'The provided credentials do not match our records.',
                ]);
            }

        } else {
            return back()->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout()
    {
        session()->forget('adminLogin');
        return redirect()->route('admin.login');
    }
}

