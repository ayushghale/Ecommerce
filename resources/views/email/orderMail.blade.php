<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Order Details</h2>
        <p><strong>Name:</strong> {{ $mailData['name'] }}</p>
        <p><strong>Total:</strong> Rs.{{ $mailData['total'] }}</p>
        <p><strong>Order ID:</strong> {{ $mailData['order_id'] }}</p>
        <p><strong>Payment Method:</strong> {{ $mailData['payment_method'] }}</p>
        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $id = 1;
                @endphp @foreach ($mailData['order_details'] as $orderDetail)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $orderDetail->product_name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>Rs. {{ $orderDetail->product_price }}</td>
                        <td>Rs. {{ $orderDetail->quantity * $orderDetail->product_price }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
