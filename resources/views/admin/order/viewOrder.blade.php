<?php
$currentNav = 'order';
$currentPage = '';
?>
<style>
    .dashboard-container {
        padding: 20px;
    }

    .dashboard-container .order-header {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .dashboard-container .order-userDetailsBilling {
        padding: 20px 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .dashboard-container .order-userDetailsBilling .userDetails,
    .billingDetails {
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .dashboard-container .order-userDetailsBilling h3 {
        margin-bottom: 10px;
    }

    .dashboard-container .orderDetails {
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .dashboard-container .orderDetails h3 {
        margin-bottom: 10px;
    }

    .dashboard-container .orderDetails table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-container .orderDetails table thead {
        background-color: #f5f5f5;
        text-align: right;
    }

    .dashboard-container .orderDetails table th,
    .dashboard-container .orderDetails table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .dashboard-container .orderDetails table th {
        background-color: #f5f5f5;
    }

    .dashboard-container .orderDetails table tbody tr:last-child td {
        border-bottom: none;
    }

    .dashboard-container .orderDetails table tbody tr td {
        border-bottom: 1px solid #ddd;
    }


    .dashboard-container .orderDetails table tbody tr td:last-child {
        width: 15%;
    }

    .dashboard-container .orderDetails table tbody tr td {
        padding: 10px;
    }

    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: right;
    }

    .dashboard-container .orderDetails table tbody tr td:first-child {
        text-transform: capitalize;
    }

    .dashboard-container .orderDetails table thead tr th:nth-child(4),
    .dashboard-container .orderDetails table thead tr th:nth-child(5),
    .dashboard-container .orderDetails table tbody tr td:nth-child(4),
    .dashboard-container .orderDetails table tbody tr td:nth-child(5),
    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: center;
    }

    .dashboard-container .orderDetails table tbody tr td:nth-child(4),
    .dashboard-container .orderDetails table tbody tr td:nth-child(5),
    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: center;
    }


    .dashboard-container .orderDetails table thead tr th:last-child,
    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: right;
    }

    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: right;
    }

    .dashboard-container .orderDetails table tbody tr td:last-child {
        text-align: right;
    }

    .dashboard-container .orderDetails table tbody tr.totalAmt {
        background-color: #555555;
        color: #fff;

    }

    .dashboard-container .orderDetails table tbody tr.totalAmt td:last-child {
        font-weight: bold;
    }

    .dashboard-container .orderDetails table tbody tr.totalAmt td {
        font-weight: bold;
    }

    .dashboard-container .orderStatus {
        margin-top: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .dashboard-container .orderStatus h3 {
        margin-bottom: 10px;
    }

    .dashboard-container .orderStatus div {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;

    }

    .dashboard-container .orderStatus div span {
        border: 2px solid;
        border-color: #555555;
        padding: 5px 10px;
        text-transform: capitalize;
        border-radius: 5px;
        font-weight: bold;
    }

    .dashboard-container .orderStatusChange {
        margin-top: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    .dashboard-container .orderStatusChange h3 {
        margin-bottom: 10px;
    }

    .dashboard-container .orderStatusChange form div {
        margin-bottom: 10px;
    }

    .dashboard-container .orderStatusChange form div label {
        display: block;
        margin-bottom: 5px;
    }

    .dashboard-container .orderStatusChange form div select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .dashboard-container .orderStatusChange form option {
        padding: 10px;
    }

    .dashboard-container .orderStatusChange form button {
        padding: 10px 20px;
        background-color: #555555;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>


@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Order Details</h1>
        </div>
        <div class="dashboard-container">
            <div class=" order-header">
                <p>Order # {{ $finalOrderData[0]['orderId'] }}</p>
                <p>{{ $finalOrderData[0]['orderDate'] }}</p>
            </div>
            {{-- user Details Billing  --}}
            <div class="order-userDetailsBilling">
                <div class="userDetails">
                    <h3>Customer Details</h3>
                    <p>Name: {{ $finalOrderData[0]['User'] }}</p>
                    <p>Email: {{ $finalOrderData[0]['UserEmail'] }}</p>
                    <p>Phone: {{ $finalOrderData[0]['UserPhone'] }}</p>
                    <p>Address: {{ $finalOrderData[0]['UserAddress'] }}</p>
                </div>
                <div class="billingDetails">
                    <h3>Billing Details</h3>
                    <p>Name: {{ $finalOrderData[0]['User'] }}</p>
                    <p>Email: {{ $finalOrderData[0]['UserEmail'] }}</p>
                    <p>Phone: {{ $finalOrderData[0]['UserPhone'] }}</p>
                    <p>Address: {{ $finalOrderData[0]['UserAddress'] }}</p>
                </div>
            </div>

            {{-- Order Details  --}}
            <div class="orderDetails">
                <h3>Order Details</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sn.</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finalOrderData[0]['orderDetails'] as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src={{ $detail['productImage'] }} alt="Product Image" width="50"
                                        height="50"></td>

                                <td>{{ $detail['productName'] }}</td>
                                <td>{{ $detail['productPrice'] }}</td>
                                <td>{{ $detail['productQuantity'] }}</td>
                                <td>{{ $detail['productSubTotal'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="totalAmt">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total Amt</td>
                            <td> Rs. {{ $finalOrderData[0]['orderTotal'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- order status --}}
            <div class="orderStatus">
                <h3>Order Status</h3>
                <div>
                    <p>Order Status: </p>
                    <span
                        style=" color:
                        @if ($finalOrderData[0]['orderStatus'] === 'pending') red; border-color: #ff0000;
                        @elseif($finalOrderData[0]['orderStatus'] === 'completed')
                            green;  border-color: green; @endif">
                        {{ $finalOrderData[0]['orderStatus'] }}
                    </span>
                </div>
                <div>
                    <p>Payment Status:</p>
                    <span
                        style="color:
                        @if ($finalOrderData[0]['PaymentStatus'] === 'pending') red; border-color: #ff0000;
                        @elseif($finalOrderData[0]['PaymentStatus'] === 'completed')
                            green; border-color: green; @endif">
                        {{ $finalOrderData[0]['PaymentStatus'] }}
                    </span>
                </div>
            </div>

            {{-- change order and payment status --}}
            <div class="orderStatusChange">
                <h3>Change Order Status</h3>
                <form method="POST"
                    action="{{ route('admin.orders.statusUpdate', ['id' => $finalOrderData[0]['orderId']]) }}">
                    @csrf
                    <div>
                        <label for="orderStatus">Order Status</label>
                        <select name="orderStatus" id="orderStatus">
                            @if ($finalOrderData[0]['orderStatus'] === 'completed')
                                    <option value="completed" selected>Completed</option>
                                    <option value="pending">Pending</option>
                                @else
                                    <option value="pending" selected>Pending</option>
                                    <option value="completed">Completed</option>
                                @endif
                        </select>
                    </div>

                    @if ($finalOrderData[0]['orderStatus'] === 'pending')
                        <div>
                            <label for="paymentStatus">Payment Status</label>
                            <select name="paymentStatus" id="paymentStatus">

                                @if ($finalOrderData[0]['PaymentStatus'] === 'completed')
                                    <option value="completed" selected>Completed</option>
                                    <option value="pending">Pending</option>
                                @else
                                    <option value="pending" selected>Pending</option>
                                    <option value="completed">Completed</option>
                                @endif
                            </select>
                        </div>

                    @endif


                    <button type="submit">Update</button>
                </form>

            </div>
        </div>
    </section>


</div>
@include('admin.include.footer')
