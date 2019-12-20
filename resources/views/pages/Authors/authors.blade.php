@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        

        <div class="list-container container">


            <li class="list-group-item m-1 d-flex justify-content-between align-items-center border-0 mt-5">
                <div class="left d-flex ">
                    <div class="lid mr-5 h5 text-bold text-black-50">ID</div>
                    <div class="lname h5 text-bold text-black-50">Author's name</div>
                </div>
                <div class="right d-flex">
                    
                </div>
            </li>

            
            <ul class="list-group list">

                @foreach ($authors as $author)
                
                    <li class="list-group-item my-2 shadow-sm d-flex justify-content-between align-items-center">
                        <div class="left d-flex ">
                            <div class="lid mr-5 ">{{$author->id}}</div>
                            <div class="lname">{{$author->name}}</div>
                        </div>
                        <div class="right d-flex">
                            <a href="{{$author->id}}/edit" class="btn-primary btn btn-sm mr-2"> <i class="fas fa-pencil-alt text-small"></i> &nbsp; Edit</a>
                            <a href="{{$author->id}}" class="btn-warning text-white btn btn-sm"> <i class="far fa-eye"></i> &nbsp; View</a>
                        </div>
                    </li>
                    
                @endforeach

            </ul>
            <div class="text-center justify-content-center d-flex mt-5">
                {{$authors}}
            </div>
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <style>
            .fa-pencil-alt,.fa-eye{
                font-size: 14px !important;
            }
        </style>
    </div>
@endsection