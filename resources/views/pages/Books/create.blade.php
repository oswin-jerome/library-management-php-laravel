@extends('layouts.app')


@section('content')
    <div id="createCate" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
            {{Form::open(['action' => ['BooksController@store'],'method'=>'POST',"class"=>"card px-5 py-3 shadow rounded-lg w-auto e border-0"])}}
                <h3 class="text-center  text-bold mb-5 mt-3 heading">Create a book</h3>
                
                
                
                {{-- <div class="form-group ">    
                    <label for="id">ID : </label>
                    <input type="text" id="id" name="id" class="form-control" required>
                </div> --}}

                <div class="form-group">    
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

            
                <div class="d-flex justify-content-center ">
                    <div class="form-group flex-grow-1">
                        <label for="exampleFormControlSelect1">Author : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="author" required>

                            @if (count($authors)<1)
                                <option disabled>Create authors first</option>
                            @else
                                @foreach ($authors as $dept)
                                    <option value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group flex-grow-1 ml-2">
                        <label for="exampleFormControlSelect1">Category : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category" required>
                            @if (count($categories)<1)
                                <option disabled>Create categoried first</option>
                            @else
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                    {{-- <div class="form-group w-100">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4" required>
                    </div> --}}


                <div class="text-center mt-3 mb-2">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            
            {{Form::close()}}

            <style>
                .heading{
                    font-weight: bold;
                    color: rgba(0,0,0,0.35);
                }

                .e{
                    min-width: 50%;
                    /* border-radius: 10px !important; */
                }
            </style>

    </div>
@endsection