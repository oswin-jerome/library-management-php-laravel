@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="top">
            <h1 class="text-center mt-5 text-bold">SmartLib LMS</h1>
            <h5 class="text-center text-muted text-small">v 1.0.0</h5>
            <h4 class="text-center mt-3">Licensed to : <span class="text-primary ml-1">St. Jerome's college of arts and science</span></h4>
        </div>
        <div class="bottom">
            <h3>Designed and developed by <span class="text-primary"><a href="https://oswin1998.cf" target="_blank">Oswin Jerome</a></span> </h3>
            <h6 class="text-center">BCA (2017 - 2020)</h6>
        </div>
    </div>

    <style>
        .container{
            /* background: red; */
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }
    </style>
@endsection