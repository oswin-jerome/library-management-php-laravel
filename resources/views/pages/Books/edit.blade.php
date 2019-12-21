@extends('layouts.app')


@section('content')
    <div id="createCate" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
            {{Form::open(['action' => ['BooksController@update',$book->id],'method'=>'PUT',"class"=>"card px-5 py-3 shadow rounded-lg w-auto e border-0"])}}
                <h3 class="text-center  text-bold mb-5 mt-3 heading">Update a book</h3>
                
                
                
                <div class="form-group">    
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$book->name}}" required>
                </div>

            
                <div class="d-flex justify-content-center ">
                    <div class="form-group flex-grow-1">
                        <label for="exampleFormControlSelect1">Author : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="author" required>

                            @if (count($authors)<1)
                                <option disabled>Create authors first</option>
                            @else
                                @foreach ($authors as $author)
                                    <option @if ($author->id == $book->author) selected @endif value="{{$author->id}}">{{$author->name}}</option>
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
                                    <option @if ($category->id == $book->category) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>


                <div class="text-center mt-3 mb-2">
                    <button type="submit" class="btn btn-warning">UPDATE</button>
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