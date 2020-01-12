@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="basicDetials">
            <h1 class="text-center mt-5 text-muted" style="font-size:50px"> {{$member->name}} </h1>
            <p class="text-center text-muted">{{$member->department->name}}   ( {{$member->id}} )</p>   
        </div>

        <div class="BooksToReturn card p-3" style="margin-top:100px">
            <h3 class="text-center mt-3" style="font-weight:bold;color:#818181;">Books to return</h3>

            @if (count($toreturn)>0)
                <table class="table table-borderless mt-3" id="bktr">
                    <thead class="text-white" style="background: #3f51b5">
                        <tr>
                            <th scope="col">Trans ID</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Rented at</th>
                            <th scope="col"></th>
                            {{-- <th scope="col">Returned at</th>
                            <th scope="col">Dept</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($toreturn as $item)
                            @if ($item->isReturned==0)
                                <tr class="bg-white cust">
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->book->name}}</td>
                                    <td>{{$item->rented_at}}</td>
                                    <td class="text-right" style="width:20% !important">
                                        <a href="#" class="btn btn-outline-primary btn-sm">Return</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center mt-3 mb-3">No Books to return</h3>
            @endif

        </div>

        <div class="rentedBooks card p-3 mb-4" style="margin-top:30px">
            <h3 class="text-center mt-3" style="font-weight:bold;color:#818181;">Rented Books</h3>
    
            @if (count($rented)>0)
                <table class="table table-borderless mt-3" id="bktr">
                    <thead class="text-white" style="background: #3f51b5">
                        <tr>
                            <th scope="col">Trans ID</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Rented at</th>
                            <th scope="col">Returned at</th>
                            {{-- <th scope="col">Dept</th> --}}
                        </tr>
                    </thead>

                    
                    <tbody>
                        @foreach ($rented as $item)
                            <tr class="bg-white cust">
                                <th scope="row">{{$item->id}}</th>
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
                <h3 class="text-center mt-3 mb-3">No Books rented</h3>
            @endif
        </div>
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