<?php
$currentPage = 'completedOrder';
$currentNav = 'order';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Completed order </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>User</th>
                            <th>User Phone</th>
                            <th>Product Quantity</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($finalOrderData as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $order['orderDate'] }}</td>
                                <td>{{ $order['User'] }}</td>
                                <td>{{ $order['UserPhone'] }}</td>
                                <td>
                                    @php
                                        $totalQuantity = 0; // Initialize total quantity counter
                                    @endphp
                                    @foreach ($order['orderDetails'] as $detail)
                                        @php
                                            // Add the quantity of each product to the total quantity counter
                                            $totalQuantity += $detail['productQuantity'];
                                        @endphp
                                    @endforeach
                                    {{ $totalQuantity }} <!-- Display the total quantity -->
                                </td>
                                <td>{{ $order['orderTotal'] }}</td>
                                <td>{{ $order['orderStatus'] }}</td>
                                <td>{{ $order['PaymentMethod'] }}</td>

                                <td>
                                    <a href="{{ route('admin.orders.view', ['id' => $order['orderId']]) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
