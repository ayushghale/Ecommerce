<?php
$currentPage = 'dashboard';
?>

<style>
    .main {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .top-display {
        display: grid;
        grid-template-columns: repeat(4, minmax(300px, 1fr));
        gap: 20px;
    }

    .top-display .dashboard-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 20px;
    }

    .top-display .dashboard-container .icon {
        font-size: 40px;
        color: #333;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        padding-top: 8px;
        border: 2px solid #b5b5b5;
        height: 80px;
        width: 80px;
        border-radius: 50%;
    }

    .top-display .dashboard-container .title {
        font-size: 20px;
        color: #333;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: left;
        text-transform: capitalize;
    }

    .charts {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 20px;
        align-items: stretch;
    }

    .charts .lineChart {
        grid-column: span 8;
        gap: 20px;
        height: 100%;
    }

    .charts .doughnut {
        grid-column: span 4;
        gap: 20px;
        height: 100%;
    }

    .charts .dashboard-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        height: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .charts .dashboard-container h4 {
        font-size: 20px;
        color: #333;
        margin-bottom: 20px;
    }

    .recentOrder {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 20px;
        align-items: stretch;
    }

    .recentOrder .dashboard-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        grid-column: span 12;
    }

    .recentOrder .dashboard-container h4 {
        font-size: 20px;
        color: #333;
        margin-bottom: 20px;
    }

    .recentOrder .dashboard-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .recentOrder .dashboard-container table thead {
        background-color: #f9f9f9;
    }

    .recentOrder .dashboard-container table th,
    .recentOrder .dashboard-container table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #f9f9f9;
    }

    .recentOrder .dashboard-container table th {
        text-transform: uppercase;
        font-size: 14px;
        color: #333;
    }

    .recentOrder .dashboard-container table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .recentOrder .dashboard-container table tbody tr:hover {
        background-color: #f1f1f1;
    }

    @media (max-width: 768px) {
        .top-display {
            grid-template-columns: repeat(2, minmax(300px, 1fr));
        }

        .charts {
            grid-template-columns: repeat(1, 1fr);
        }

        .charts .lineChart {
            grid-column: span 12;
        }

        .charts .doughnut {
            grid-column: span 12;
        }

        .recentOrder {
            grid-template-columns: repeat(1, 1fr);
        }

        .recentOrder .dashboard-container {
            grid-column: span 12;
        }
    }
</style>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Dashboard </h1>
        </div>
        <div class=" top-display">
            <div class="dashboard-container">
                <div class="icon">
                    <i class="fa-solid fa-user"  style="font-size: 100%;"></i>
                </div>
                <div class="title">
                    <h4>
                        Total Users
                    </h4>
                    <p>{{$totalUsers}}</p>
                </div>
            </div>
            <div class="dashboard-container">
                <div class=" icon">
                    <i class="fa-solid fa-bag-shopping"  style="font-size: 100%;"></i>
                </div>
                <div class="title">
                    <h4>
                        Product
                    </h4>
                    <p>{{$totalProducts}}</p>
                </div>
            </div>
            <div class="dashboard-container">
                <div class=" icon">
                    <i class="fa-solid fa-cart-shopping" style="font-size: 100%;"></i>
                </div>
                <div class="title">
                    <h4>
                        Total Orders
                    </h4>
                    <p>{{$totalOrder}}</p>
                </div>
            </div>
            <div class="dashboard-container">
                <div class=" icon">Rs.
                </div>
                <div class="title">
                    <h4>
                        Total Sales
                    </h4>
                    <p>Rs. {{$totalSales}}</p>
                </div>
            </div>
        </div>
        <div class="charts">
            <div class="lineChart">
                <div class="dashboard-container">
                    <h4> Monthly Sales</h4>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="doughnut">
                <div class="dashboard-container">
                    <h4> Payment method</h4>
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>

        <div class="recentOrder">
            <div class="dashboard-container">
                <h4> Recent Orders</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $order['User'] }}</td> <!-- Access 'User' using array notation -->
                                <td>{{ $order['orderDate'] }}</td> <!-- Access 'orderDate' similarly -->
                                <td>{{ $order['orderStatus'] }}</td> <!-- Access 'orderStatus' similarly -->
                                <td>{{ $order['orderTotal'] }}</td> <!-- Access 'orderTotal' similarly -->
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the monthly sales data from the PHP variable
    const monthlySales = @json($monthlySales);
    const paymentMethods = @json($paymentMethod);

    // Extract month names and sales totals from the monthly sales data
    const lineChartLabels = monthlySales.map(item => item.month);
    const lineChartSalesData = monthlySales.map(item => item.total);

    // Extract payment method names and totals from the payment method data
    const doughnutLabels = paymentMethods.map(item => item.paymentMethod);
    const doughnutData = paymentMethods.map(item => item.count);

    const lineChart = document.getElementById('lineChart');
    const doughnut = document.getElementById('doughnut');

    new Chart(lineChart, {
        type: 'line',
        data: {
            labels: lineChartLabels, // Use month names as labels
            datasets: [{
                label: 'Monthly Sales',
                data: lineChartSalesData, // Use sales totals as data
                fill: true,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false,
                    position: "top",
                },
            },
        },
    });

    new Chart(doughnut, {
        type: 'doughnut',
        data: {
            labels: doughnutLabels, // Update with actual payment method names
            datasets: [{
                label: doughnutLabels,
                data: doughnutData, // Update with actual payment method totals
                backgroundColor: [
                    'rgb(104, 104, 104 )',
                    'rgb(104, 255, 0 )',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
    });
</script>


@include('admin.include.footer')
