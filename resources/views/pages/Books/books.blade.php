@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        

        <div class="list-container container">
            
            <table class="table table-borderless">
                <thead class="">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    {{-- <th scope="col" class="contols">Controls</th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach ($books as $book)
                        
                        <tr class="cust bg-white">
                            <th scope="row" class="">{{$book->id}}</th>
                            <td>{{$book->name}}</td>
                            <td>{{$book->auth->name}}</td>
                            <td>{{$book->cate->name}}</td>
                            <td class="contols">
                                <a href="/books/{{$book->id}}/edit" class="btn-primary btn btn-sm mr-2"> <i class="fas fa-pencil-alt text-small"></i> &nbsp; Edit</a>
                                <a href="/books/{{$book->id}}" class="btn-warning text-white btn btn-sm"> <i class="far fa-eye"></i> &nbsp; View</a>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
                </table>
            
            <div class="text-center justify-content-center d-flex mt-5">
                {{$books}}
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

            .cust{
                /* background-color: red !important; */
                box-shadow: rgba(0,0,0,.15) 0px 3px 8px;
                border-radius: 5px;
            }
            .contols{
                text-align: center;
                width: 20% !important;
            }
            .table{
                border-collapse:separate; 
                border-spacing: 0 15px; 
            }


        </style>
    </div>
@endsection