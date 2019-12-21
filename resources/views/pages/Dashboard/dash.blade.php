@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <div id="dash">
            
            <div class="top-bar">

                <div class="item animated bounceIn">
                    <div class="pattern "></div>
                    <p class="title">  Total Members</p>
                    <p class="value">{{$total_members}}</p>
                </div>
                <div class="item animated bounceIn">
                    <div class="pattern "></div>
                    <p class="title">Total no. of books</p>
                    <p class="value">{{$total_books}}</p>
                </div>
                <div class="item animated bounceIn">
                    <div class="pattern"></div>
                    <p class="title">Books to be returned</p>
                    <p class="value">42</p>
                </div>
                <div class="item animated bounceIn">
                    <div class="pattern"></div>
                    
                    <p class="title">No. of books taken</p>
                    <p class="value">92</p>
                </div>
            </div>
            <div id="chart">
                <canvas id="myChart"></canvas>
            </div>
            
        </div>

        <script>
            var ctx = document.getElementById('myChart').getContext("2d");
            var gradientFill = ctx.createLinearGradient(0, 800, 00, 00);
            gradientFill.addColorStop(1, "rgba(113, 88, 226, 1)");
            gradientFill.addColorStop(0, "rgba(255, 255, 255, 0.0)");

            var gradientFill2 = ctx.createLinearGradient(0, 800, 00, 00);
            gradientFill2.addColorStop(1, "rgba(255, 0, 0, 1)");
            gradientFill2.addColorStop(0, "rgba(255, 255, 255, 0.0)");
            console.log(gradientFill)
            var data = {
                type: 'line',
                label:"Books rented",
                labels: ['January', 'February', 'March', 'April', 'May',],
                datasets: [
                    {
                    label:"Books rented",
                    backgroundColor:gradientFill,
                    borderColor: '#7158E2',
                    data: [
                        100,
                        20, 30, 150,10
                    ],
                },
                    {
                    label:"Books returned",
                    backgroundColor:gradientFill2,
                    borderColor:"red",
                    data: [
                        0,
                        11, 50, 120,50
                    ],
                },
            ]
            }

            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    showLine: true
                }
            });
        </script>
@endsection