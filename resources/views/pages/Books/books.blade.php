@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        

        <div class="list-container container">
            <div class="search text-center mt-2">
                <i class="fas fa-search text-small text-black-50" id="toggleSearch"></i>
            </div>


             {{Form::open(['action'=>'BooksController@index','method'=>'GET','class'=>'hides','id'=>'form'])}}
                <div class="row d-flex justify-content-center align-content-center align-items-center mt-3 shadow-sm border-0 p-1">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Find using : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="key">
                            <option @isset($parms['key']) @if ($parms['key']=='id') selected @endif @endisset value="id">ID</option>
                            <option @isset($parms['key']) @if ($parms['key']=='name') selected @endif @endisset value="name">Book Name</option>
                            <option @isset($parms['key']) @if ($parms['key']=='author') selected @endif @endisset value="author">Author</option>
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="ID">Value :</label>
                        <input @isset($parms['value']) @if ($parms['value']=='')
                        @else
                            value={{$parms['value']}}
                        @endif @endisset type="text" class="form-control" name="value" id="ID">
                    </div>

                    <div class="form-group ml-3">
                        <label for="exampleFormControlSelect1">Categories: </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="showCate">
                            <option @isset($parms['showCate']) @if ($parms['showCate']=='0') selected @endif @endisset value="0">All</option>
                            @foreach ($categories as $category)
                                <option @isset($parms['showCate']) @if ($parms['showCate']==$category->id) selected @endif @endisset value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="exampleFormControlSelect1">Filter using : </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="filter">
                            <option @isset($parms['filter']) @if ($parms['filter']=='id') selected @endif @endisset value="id">ID</option>
                            <option @isset($parms['filter']) @if ($parms['filter']=='name') selected @endif @endisset value="name">Name</option>
                            <option @isset($parms['filter']) @if ($parms['filter']=='author') selected @endif @endisset value="author">Author</option>
                            <option @isset($parms['filter']) @if ($parms['filter']=='category') selected @endif @endisset value="category">Category</option>
                            {{-- <option @isset($parms['filter']) @if ($parms['filter']=='dept') selected @endif @endisset value="dept">Dept</option> --}}
                        </select>
                    </div>

                    <div class="form-group ml-3">
                        <label for="exampleFormControlSelect1">Filter using : </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="arrange">
                            <option @isset($parms['arrange']) @if ($parms['arrange']=='asc') selected @endif @endisset value="asc">Assending</option>
                            <option @isset($parms['arrange']) @if ($parms['arrange']=='desc') selected @endif @endisset value="desc">Decending</option>
                        </select>
                    </div>

                    <div class="form-group ml-4 mt-2">
                        <button type="submit" name="submit" value="search" class="btn btn-primary mt-4">Search</button>
                    </div>


                </div>
            {{Form::close()}}

            @if (count($books)<1)
                <h1 class="mt-5 heading text-center text-grey">No Books</h1>
            @else
                <table class="table table-borderless" id="myTable">
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
            @endif
            <div class="text-center justify-content-center d-flex mt-5">
                {{$books}}
            </div>
        </div>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <style>
            .fa-pencil-alt,.fa-eye{
                font-size: 14px !important;
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
        <script>
            var el = document.getElementById('toggleSearch');
            var elf = document.getElementById('form');
            el.addEventListener('click',()=>{
                elf.classList.toggle('hide');
            });
        </script>
    </div>
@endsection