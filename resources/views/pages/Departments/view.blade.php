@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-5 mb-5 text-secondary" style="font-size:50px">{{$department->name}}</h1>

    <div class="booksCategory card p-3 mb-4 ml-2 mr-2" style="margin-top:60px">
        <h3 class="text-center mt-3 mb-4" style="font-weight:bold;color:#818181;">Members under this department</h3>
        @if (count($members)>0)
            <table class="table table-borderless mt-3" id="bktr">
                <thead class="text-white" style="background: #3f51b5">
                    <tr>
                        <th scope="col">Member ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Type</th>
                        {{-- <th scope="col">Dept</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $item)
                        <tr class="bg-white cust">
                            <th scope="row">{{$item->id}}</th>
                            {{-- <td>{{$item->name}}</td> --}}
                            <td><a href="/members/{{$item->id}}">{{$item->name}}</a></td>
                            <td>{{$item->department->name}}</td>
                            <td>@if ($item->type == 1)
                                Student
                            @else
                                Staff
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center mt-3 mb-3">No members in this department</h3>
        @endif
    </div>


    <div class="booksCategory card p-3 mb-4 ml-2 mr-2" style="margin-top:60px">
        <h3 class="text-center mt-3 mb-4" style="font-weight:bold;color:#818181;">Books taken by members in this department</h3>
        @if (count($members)>0)
            <table class="table table-borderless mt-3" id="bktr">
                <thead class="text-white" style="background: #3f51b5">
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Member Name</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">rented at</th>
                        <th scope="col">returned at</th>
                        {{-- <th scope="col">Dept</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr class="bg-white cust">
                            <th scope="row">{{$item->id}}</th>
                            <td><a href="/members/{{$item->member->id}}">{{$item->member->name}}</a></td>
                            <td>{{$item->book->name}}</td>
                            <td>{{$item->rented_at}}</td>
                            <td>@if ($item->returned_at=="")
                                <span class="text-danger">Not returned</span>
                            @else
                                {{$item->returned_at}}
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center mt-3 mb-3">No members in this department</h3>
        @endif
    </div>

    <style>
        .cust{
            /* background-color: red !important; */
            box-shadow: rgba(0,0,0,.15) 0px 3px 8px;
            border-radius: 15px !important;
            justify-content: center;
            align-items: center;
        }
        .table{
            border-collapse:separate; 
            border-spacing: 0 15px; 
        }
    </style>    
@endsection