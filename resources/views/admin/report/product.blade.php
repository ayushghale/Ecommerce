<?php
$currentNav = 'report';
$currentPage = 'productReport';
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
        grid-column: span 12;
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
            <h1>Product report </h1>
        </div>
        <div class="recentOrder">
            <div class="dashboard-container">
                <h4> Highest sold product </h4>
                <table>
                    <thead>
                        <tr>
                            <th>Sn.</th>
                            <th>Customer Name</th>
                            <th>Quantity sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($top5SoldProducts as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $order['name'] }}</td>
                                <td>{{ $order['quantity'] }}</td>

                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="recentOrder">
            <div class="dashboard-container">
                <h4> lowest sold product </h4>
                <table>
                    <thead>
                        <tr>
                            <th>Sn.</th>
                            <th>Customer Name</th>
                            <th>Quantity sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($worst5SoldProducts as $order)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $order['name'] }}</td>
                                <td>{{ $order['quantity'] }}</td>

                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>


@include('admin.include.footer')
