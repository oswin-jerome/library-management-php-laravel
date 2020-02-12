@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" defer></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css"> 
<div id="dash">
            
            <div class="top-bar">

                <div class="item animated bounceIn ">
                <div class="pattern "></div>
                    <p class="title">  Total Members</p>
                    <p class="value">{{$total_members}}</p>
                </div>
                <div class="item animated bounceIn ">
                    <div class="pattern "></div>
                    <p class="title">Total no. of books</p>
                    <p class="value">{{$total_books}}</p>
                </div>
                <div class="item animated bounceIn ">
                    <div class="pattern"></div>
                    <p class="title">No. of books taken</p>
                    <p class="value">{{$booksTaken}}</p>
                </div>
                <a href="pendingbooks" class="item animated bounceIn">
                    <div class=" ">
                        <div class="pattern"></div>
                        <p class="title">Books to be returned</p>
                        <p class="value">{{count($btor)}}</p>
                    </div>
                </a>
            </div>
            {{-- <div id="chart">
                <canvas id="myChart"></canvas>
            </div> --}}

            <div class="chart-container">
                <div class="chart" style="grid-area: memberD;">
                    {!! $memberChart->container() !!}
                </div>
                <div class="chart" style="grid-area: memberT;">
                    {!! $memberTypeChart->container() !!}
                </div>
                <div class="chart" style="grid-area: bookINC;">
                    <h3 class="text-center mb-3">Books per category</h3>
                    {!! $bookInCategoryC->container() !!}
                </div>
                <div class="chart" style="grid-area: booksAdC;">
                    {{-- <h3 class="text-center mb-3">Books added</h3> --}}
                    {!! $booksAddedChart->container() !!}
                </div>
                <div class="chart" style="grid-area: membersAdC;">
                    {{-- <h3 class="text-center mb-3">Members added</h3> --}}
                    {!! $membersAddedChart->container() !!}
                </div>
                <div class="chart" style="grid-area: transdC;">
                    {{-- <h3 class="text-center mb-3">Books rented</h3> --}}
                    {!! $TransactionChart->container() !!}
                </div>
                <div class="chart" style="grid-area: transdRtnC;">
                    {{-- <h3 class="text-center mb-3">Books rented</h3> --}}
                    {!! $transRtnChart->container() !!}
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            {!! $memberChart->script() !!}
            {!! $memberTypeChart->script() !!}
            {!! $bookInCategoryC->script() !!}
            {!! $booksAddedChart->script() !!}
            {!! $membersAddedChart->script() !!}
            {!! $TransactionChart->script() !!}
            {!! $transRtnChart->script() !!}
        </div>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>

            

            var ctx = document.getElementById('myChart').getContext("2d");
            var gradientFill = ctx.createLinearGradient(0, 800, 00, 00);
            gradientFill.addColorStop(1, "rgba(61, 90, 241, 0.8)");
            gradientFill.addColorStop(0, "rgba(61, 90, 241, 0.0)");

            var gradientFill2 = ctx.createLinearGradient(0, 800, 00, 00);
            gradientFill2.addColorStop(1, "rgba(248, 89, 89, 0.8)");
            gradientFill2.addColorStop(0, "rgba(248, 89, 89, 0.0)");
            console.log(gradientFill)
            var data = {
                type: 'line',
                label:"Books rented",
                labels: ['January', 'February', 'March', 'April', 'May',],
                datasets: [
                    {
                    label:"Books rented",
                    backgroundColor:gradientFill,
                    borderColor: '#3d5af1',
                    data: [
                        100,
                        20, 30, 150,10
                    ],
                },
                    {
                    label:"Books returned",
                    backgroundColor:gradientFill2,
                    borderColor:"#f85959",
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
        </script> --}}


    <style>
        
        .chart{
            border-radius: 10px;
            box-shadow: rgba(0,0,0,0.20) 3px 3px 8px;
            padding: 15px;
            
        }

        .chart-container{
            width: 95%;
            margin: auto;
            display: grid;
            /* grid-template-columns: 3fr 1fr; */
            grid-template-areas: 
                                'memberD memberD memberD memberT memberT'
                                'bookINC bookINC bookINC bookINC bookINC'
                                /* 'transdC transdC transdC membersAdC membersAdC' */
                                'transdC transdC transdC transdC transdC'
                                'membersAdC membersAdC membersAdC membersAdC membersAdC'
                                'booksAdC booksAdC booksAdC booksAdC booksAdC'
                                'transdRtnC transdRtnC transdRtnC transdRtnC transdRtnC'
            ;
            grid-column-gap: 25px;
            grid-row-gap: 50px;
        }
    </style>
@endsection