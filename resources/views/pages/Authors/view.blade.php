@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-center mt-5 text-secondary" style="font-size:50px"> <span class=" text-muted">{{$author->id}} : </span> {{$author->name}}</h1>
    </div>
    <div class="rentedBooks card p-3 mb-4 ml-2 mr-2" style="margin-top:60px">
        <h3 class="text-center mt-3" style="font-weight:bold;color:#818181;">Books by this author</h3>
        @if (count($books)>0)
            <table class="table table-borderless mt-3" id="bktr">
                <thead class="text-white" style="background: #3f51b5">
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Book added at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr class="bg-white cust">
                            <th scope="row">{{$item->id}}</th>
                            <td><a href="/books/{{$item->id}}">{{$item->name}}</a></td>
                            <td><a href="/categories/{{$item->cate->id}}">{{$item->cate->name}}</a></td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center mt-3 mb-3">No books by this author</h3>
        @endif
    </div>
    <style>
        .cust{
            box-shadow: rgba(0,0,0,.15) 0px 3px 8px;
            border-radius: 15px !important;
            justify-content: center;
            align-items: center;
        }
        .table{
            border-collapse:separate; 
            border-spacing: 0 15px; 
        }

        .text{
            color: gray;
        }
        
    </style>
@endsection