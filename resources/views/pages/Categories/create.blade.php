@extends('layouts.app')


@section('content')
    <div id="createCate" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
            {{Form::open(['action' => ['CategoriesController@store'],'method'=>'POST',"class"=>"card px-5 py-3 shadow rounded-lg w-auto"])}}
                <h3 class="text-center  text-bold mb-4 mt-2 heading">Create a category</h3>
                <div class="form-group">    
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            
            {{Form::close()}}

            <style>
                .heading{
                    font-weight: bold;
                    color: rgba(0,0,0,0.35);
                }
            </style>

    </div>
@endsection