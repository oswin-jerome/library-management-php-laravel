@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center mt-5 text-secondary" style="font-size:50px"> <span class=" text-muted">{{$book->id}} : </span> {{$book->name}}</h1>
        {{-- <h4 class="text-center mt-3 grey">by {{$book->author[0]->name}}</h4> --}}
        <h4 class="text-center mt-3 grey">by @foreach ($book->author as $item)
            {{$item->name.' ,' }}
        @endforeach</h4>
        <h4 class="text-center mt-3 grey">{{$book->cate->name}}</h4>
        <h6 class="text-center mt-3 text-success">{{$book->detials}}</h6>


        <div class="rentedBooks card p-3 mb-4 ml-2 mr-2" style="margin-top:60px">
            <h3 class="text-center mt-3" style="font-weight:bold;color:#818181;">Members rented this Books</h3>
            @if (count($members)>0)
                <table class="table table-borderless mt-3" id="bktr">
                    <thead class="text-white" style="background: #3f51b5">
                        <tr>
                            <th scope="col">Trans ID</th>
                            <th scope="col">Member Name</th>
                            <th scope="col">Rented at</th>
                            <th scope="col">Returned at</th>
                            {{-- <th scope="col">Dept</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $item)
                            <tr class="bg-white cust">
                                <th scope="row">{{$item->id}}</th>
                                <td><a href="/members/{{$item->member->id}}">{{$item->member->name}}</a></td>
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
                <h3 class="text-center mt-3 mb-3">No one rented this book</h3>
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

        .grey{
            color: #818181;
        }
    </style>
@endsection