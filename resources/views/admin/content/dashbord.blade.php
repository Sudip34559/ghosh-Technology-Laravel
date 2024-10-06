@extends('admin.layout.layout')

@section('adminSection')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content pt-4"  >
        <div class="container-fluid" >
            <!-- Small boxes (Stat box) -->
            <div class="row" style="max-width: 1000px; margin-left: auto;
            margin-right: auto;">
                <!-- Total Products -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="totalProducts">{{$totalProducts}}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
                <!-- Product Stock -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="productStock">{{$totalQuantity}}</h3>
                            <p>Product Stock</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                    </div>
                </div>
                <!-- Total Customers -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="totalCustomers" style="color: white">{{$customer}}</h3>
                            <p style="color: white">Total Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <!-- Total Sales -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="totalSales">₹{{$totalSell}}</h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            {{-- <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1001</td>
                            <td>John Doe</td>
                            <td>Smartphone</td>
                            <td>2</td>
                            <td>$1,200</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <!-- More rows as needed -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div> --}}
           
            <!-- Donut Chart Card -->
           
            <div class="card" style="max-width: 860px;margin-left: auto;
            margin-right: auto;">
                <div class="card-header">
                    <h3 class="card-title">Customer Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="myDonutChart" style="height:250px; min-height:250px"></canvas>
                </div>
            </div>
            
            
            @if (Auth::user()->role == 'admin')
            <div class="card" style="max-width: 860px; margin-left: auto;
            margin-right: auto;">
                <div class="card-header">
                    <h3 class="card-title">Monthly Calls Bar Chart - {{ $currentYear }}</h3>
                    <div class="card-tools">
                        <!-- Navigation Buttons -->
                        <a href="{{ route('admin.dashbord', ['year' => $currentYear - 1]) }}" class="btn btn-sm btn-primary">Previous Year</a>
                        @if($currentYear < Carbon\Carbon::now()->year)
                            <a href="{{ route('admin.dashbord', ['year' => $currentYear + 1]) }}" class="btn btn-sm btn-primary">Next Year</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" style="height:250px; min-height:250px"></canvas>
                </div>
            </div>
            @endif

            <div class="card" style="max-width: 860px; margin-left: auto;
            margin-right: auto;">
                <div class="card-header">
                    <h3 class="card-title">Monthly Sales - {{ $sellChart['year']  }}</h3>
                    <div class="card-tools" style="display: flex; gap:3px">
                        <!-- Navigation Buttons -->
                        <form action="{{route('admin.dashbord')}}">
                            <input type="hidden" name="year2" value="{{ $sellChart['year'] - 1 }}" >
                            <button class="btn btn-sm btn-primary">Previous Year</button>
                        </form>
                        @if($sellChart['year'] < Carbon\Carbon::now()->year)
                        <form action="{{route('admin.dashbord')}}">
                            <input type="hidden" name="year2" value="{{ $sellChart['year'] + 1 }}" >
                            <button class="btn btn-sm btn-primary">Next Year</button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
<style>
     .chart-container {
            position: relative;
            width: 80%;
            margin: auto;
        }
        canvas {
            max-height: 400px;
        }
        .year-buttons {
            text-align: center;
            margin: 20px 0;
        }
        .year-buttons button {
            padding: 10px 20px;
            margin: 0 10px;
        }
</style>
<script>
    // Data for the Donut Chart
    const user = `{{Auth::user()->role}}`;
    var donutData = {
        labels: @json($chartData['labels']),
        datasets: [{
            data: @json($chartData['data']),
            backgroundColor: [
                '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
                '#d2d6de', '#FF6384', '#36A2EB', '#FFCE56'
            ]
        }]
    };

    // Options for the Donut Chart
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        cutout: '50%', // Creates the donut hole
        plugins: {
            legend: {
                display: true,
                position: 'right'
            }
        }
    };

    // Render the Donut Chart
    var ctx = document.getElementById('myDonutChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });

    // Data for the Bar Chart
    if (user === 'admin') {
        var barData = {
        labels: @json($barChartData['months']).map(month => new Date(month).toLocaleString('default', { month: 'long' })),
        datasets: [{
            label: 'Monthly Calls',
            data: @json($barChartData['calls']),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Options for the Bar Chart
    var barOptions = {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Render the Bar Chart
    var ctx = document.getElementById('myBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: barData,
        options: barOptions
    });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', // Line chart for sales
            data: {
                labels: {!! json_encode($sellChart['months']) !!}, // Months data from Laravel
                datasets: [{
                    label: 'Sales Amount',
                    data: {!! json_encode($sellChart['sales']) !!}, // Sales data from Laravel
                    borderColor: '#4CAF50', // Line color
                    backgroundColor: 'rgba(76, 175, 80, 0.2)', // Fill color
                    borderWidth: 2,
                    pointRadius: 5,
                    pointBackgroundColor: '#FF6384', // Point color
                    pointBorderColor: '#fff',
                    tension: 0.4 // Smooth curve
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sales Amount'
                        }
                    }
                }
            }
        });
    });
    
</script>
@endsection
