@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        

        <div class="list-container container">


            <li class="list-group-item m-1 d-flex justify-content-between align-items-center border-0 mt-5">
                <div class="left d-flex flex-grow-1">
                    <div class="lid h5 text-bold text-black-50">ID</div>
                    <div class="lname h5 text-bold text-black-50">Member name</div>
                    <div class="lemail h5 text-bold text-black-50">email</div>
                    <div class="ltype h5 text-bold text-black-50">Type</div>
                    <div class="ldept h5 text-bold text-black-50">Dept</div>
                </div>
                <div class="right d-flex">
                    <a  href="#" class="btn-primaryd text-white btn btn-sm mr-2 button-red"> <i class="fas fa-pencil-alt text-small"></i> &nbsp; Edit</a>
                    <a href="#" class="btn-warnings text-white btn btn-sm"> <i class="far fa-eye"></i> &nbsp; View</a>
                    
                </div>
            </li>

            
            <ul class="list-group list">

                @foreach ($members as $member)
                    
                    <li class="list-group-item my-2 shadow-sm d-flex justify-content-between align-items-center">
                        <div class="left d-flex flex-grow-1 ma flex-wrap">
                            <div class="lid text-info text-bold">{{$member->id}}</div>
                            <div class="lname ">{{$member->name}}</div>
                            <div class="lemail">{{$member->email}}</div>
                            <div class="ltype">@if ($member->type==1) Student @else Staff @endif</div>
                            <div class="ldept">{{$member->department->name}}</div>
                        </div>
                        <div class="right d-flex">
                            <a href="/members/{{$member->id}}/edit" class="btn-primary btn btn-sm mr-2"> <i class="fas fa-pencil-alt text-small"></i> &nbsp; Edit</a>
                            <a href="/members/{{$member->id}}/" class="btn-warning text-white btn btn-sm"> <i class="far fa-eye"></i> &nbsp; View</a>
                        </div>
                    </li>
                    
                @endforeach

            </ul>
            <div class="text-center justify-content-center d-flex mt-5">
                {{-- {{$departments}} --}}
            </div>
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <style>
            .fa-pencil-alt,.fa-eye{
                font-size: 14px !important;
            }

            .lid{
                flex: 1;
                font-weight: bold;
            }
            .lname{
                flex: 2;
            }
            .lemail{
                flex: 3;
                min-width: 300px;
            }
            .ltype{
                flex: 1;
            }
            .ldept{
                flex: 1;
            }

            
        </style>
    </div>
@endsection