@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-5 mb-5 text-secondary" style="font-size:50px">{{$category->name}}</h1>
    <div class="booksCategory card p-3 mb-4 ml-2 mr-2" style="margin-top:60px">
        <h3 class="text-center mt-3 mb-4" style="font-weight:bold;color:#818181;">Books under this category</h3>
        @if (count($books)>0)
            <table class="table table-borderless mt-3" id="bktr">
                <thead class="text-white" style="background: #3f51b5">
                    <tr>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author</th>
                        {{-- <th scope="col">Dept</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr class="bg-white cust">
                            <th scope="row">{{$item->id}}</th>
                            <td><a href="/books/{{$item->id}}">{{$item->name}}</a></td>
                            <td><a href="/categories/{{$item->cate->id}}">{{$item->cate->name}}</a></td>
                            {{-- <td><a href="/authors/{{$item->auth->id}}">{{$item->auth->name}}</a></td> --}}
                            <td>@foreach ($item->author as $item)
                                <a href="/authors/{{$item->id}}">{{$item->name}}</a>,
                                {{-- {{$item->name.' ,' }} --}}
                            @endforeach</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center mt-3 mb-3">No books in this category</h3>
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