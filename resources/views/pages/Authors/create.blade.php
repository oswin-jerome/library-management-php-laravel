@extends('layouts.app')


@section('content')
    <div id="createAuthor" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
        
            {{Form::open(['action' => ['AuthorsController@store'],'method'=>'POST',"class"=>"card px-5 py-3 shadow rounded-lg w-auto"])}}
                
                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            
            {{Form::close()}}

    </div>
@endsection