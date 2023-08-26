@extends('layouts.internal')

@section('content')
    <style>
        .small-box {
            color: #fff;
            padding: 0 0 3px;
            margin: 0 0 25px;
            border-radius: 10px 10px 0 0;
            display: block;
        }

        .gradient-1 {
            background: linear-gradient(to right, #19bbd2, #2778ee);
        }

        .gradient-2 {
            background: linear-gradient(to right, #8f70e7, #c452ef);
        }

        .gradient-3 {
            background: linear-gradient(to right, #e84a94, #ae379b);
        }

        .gradient-4 {
            background: linear-gradient(to right, #fecb4b, #e69814);
            /* background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18); */
        }
    </style>
    <div class="container">
        <div class="row">
            {{-- Customer Register Details --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-1">
                    <div class="inner">
                        <h4>{{ $data }}</h4>
                        <p>Customer Register</p>
                    </div>

                    <a href="Total_customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- Customer Booking History --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-2 text-white">
                    <div class="inner">
                        <h4>{{ $customer_history_count }}</h4>
                        <p>Customer Booking Entries</p>
                    </div>
                    <a href="Customer_History" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-3">
                    <div class="inner">
                        <h4>{{ $todays }}</h4>
                        <p>Today's Visited Customers</p>
                    </div>

                    <a href="Todays_customer" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-4">
                    <div class="inner" style="">
                        <h4>{{ $Weeks }}</h4>

                        <p>Last 7 Days Customers</p>
                    </div>

                    <a href="Weeks_customer" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-2 bg-danger">
                    <div class="inner">
                        <h4>{{ $Months }}</h4>
                        <p>This Month's Customers</p>
                    </div>

                    <a href="Months_customer" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary gradient-4 text-white">
                    <div class="inner">
                        <h4>{{ $booking }}/{{ $totaloccupancy }} ({{ round($percent) }}%)</h4>
                        <p> Avrage Bookings </p>
                        {{-- <h4>{{ round($rate) }}</h4>
                        <p>Monthly Avrage RoomRent</p> --}}
                    </div>

                    <a href="Monthly_Bill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger gradient-2">
                    <div class="inner">
                        <h4>{{ $mostVistited }}</h4>
                        <p>Most Visited Customers</p>
                    </div>
                    <a href="MostVistited" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box gradient-3 bg-secondary">
                    <div class="inner">
                        <h4>{{ $leastVistited }}</h4>
                        <p>Least Visited Customers</p>
                    </div>
                    <a href="LeastVistited" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning gradient-1 text-white">
                    <div class="inner">
                        <h4>{{ $company_count }}</h4>
                        <p>Companies Registered</p>
                    </div>
                    <a href="company_bookings" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Visualization/Maps/Charts --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <!-- Pie CHART Start -->
                <div class="card card-success">
                    <div class="card-header gradient-2">
                        <h3 class="card-title">City chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <head>
                        <script src="https://www.gstatic.com/charts/loader.js"></script>
                        <script>
                            google.charts.load("current", {
                                packages: ["corechart"]
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['city', 'count'],
                                    <?php echo $chartdata; ?>
                                ]);
                                var options = {
                                    title: 'City Chart',
                                    pieHole: 0.4,
                                };
                                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                chart.draw(data, options);
                            }
                        </script>

                    </head>
                    <div class="card-body">
                        <div id="donutchart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>

            <!-- Pie Start -->

            <head>
                <!-- Include Leaflet CSS and JavaScript -->
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                <style>
                    #map {
                        width: 75%;
                        height: 500px;
                        !important
                    }
                </style>
            </head>
            <!-- Replace the pie chart div with the map div -->
            <!-- Add a title div above the map -->
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-success">
                    <div class="card-header text-center gradient-3">
                        <h2 class="card-title">City Data by District on Map</h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="map" class="container">
                        </div>
                    </div>
                </div>
                <script>
                    var map = L.map('map').setView([19.7515, 75.7139], 5.1); // Set view to Maharashtra, India with zoom level 6
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 9,
                        minZoom: 4,
                    }).addTo(map);

                    var cityData = [
                        <?php echo $chartdata; ?> // Assuming your $cityData variable contains the array data
                    ];
                    // Function to geocode city names and add markers
                    function geocodeAndAddMarker(cityName, count) {
                        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + cityName;

                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    var latitude = parseFloat(data[0].lat);
                                    var longitude = parseFloat(data[0].lon);
                                    var marker = L.marker([latitude, longitude]).addTo(map);
                                    marker.bindPopup(cityName + '<br>Count: ' + count);
                                }
                            });
                    }

                    for (var i = 0; i < cityData.length; i++) {
                        var city = cityData[i][0];
                        var count = parseInt(cityData[i][1]);
                        geocodeAndAddMarker(city, count);
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
