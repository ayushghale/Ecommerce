<?php
$currentNav = 'report';
$currentPage = 'orderReport';
?>

<style>
    .main {
        display: flex;
        flex-direction: column;
        gap: 20px;
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

    .charts .orderStatus {
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

    .recentOrder .dashboard-container table th:nth-child(1) {
        width: 5%;
    }

    .recentOrder .dashboard-container table th:last-child,
    .recentOrder .dashboard-container table td:last-child{
        text-align: center;
    }

    .recentOrder .dashboard-container table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .recentOrder .dashboard-container table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .recentOrder .dashboard-container table tbody tr td {
        font-size: 14px;
        color: #333;
    }

    .recentOrder .dashboard-container table tbody tr td button {
        padding: 5px 10px;
        width: 50%;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }



    .progressBar {
        background-color: #9b9b9b;
        border-radius: 5px;
        height: 20px;
        width: 100%;
        margin-bottom: 10px;
    }


    .progress {
        background-color: #333;
        height: 100%;
        border-radius: 5px;
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
            <h1>Order report </h1>
        </div>
        <div class="charts">
            <div class="lineChart">
                <div class="dashboard-container">
                    <h4> Monthly order</h4>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            <div class="orderStatus">
                <div class="dashboard-container">
                    <h4>Order status</h4>
                    <div class="">
                        <h4>Completed : {{ $totalOrderStatus['completed'] }}</h4>

                        <div class="progressBar">
                            <div class="progress"
                                style="width: {{ ($totalOrderStatus['completed'] / $totalOrderStatus['total']) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h4>Pending : {{ $totalOrderStatus['pending'] }}</h4>
                        <div class="progressBar">
                            <div class="progress"
                                style="width: {{ ($totalOrderStatus['pending'] / $totalOrderStatus['total']) * 100 }}%">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="recentOrder">
            <div class="dashboard-container">
                <h4> Highest Order amount</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Sn.</th>
                            <th>Customer Name</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($topOrderTotal as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $order['name'] }}</td>
                                <td>{{ $order['total'] }}</td>
                                <td>
                                    <button class="edit-user">
                                        <a href="{{ route('admin.orders.view', ['id' => $order['id']]) }}"
                                            style="color: white">View Details</a>
                                    </button>
                                </td>
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
    const monthlyOrderCount = @json($monthlyOrderCount);

    // Extract month names and sales totals from the monthly sales data
    const lineChartLabels = monthlyOrderCount.map(item => item.month);
    const lineChartSalesData = monthlyOrderCount.map(item => item.count);

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
</script>


@include('admin.include.footer')
