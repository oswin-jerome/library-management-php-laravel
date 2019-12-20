@extends('layouts.app')


@section('content')
    <div id="editAuthor" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
        {{-- <form action="" class="card px-5 py-3 shadow rounded-lg w-auto"> --}}
            {{-- <div class="form-group">
                <label for="id">ID : </label>
                <input type="text" id="id" name="name" class="form-control" value="{{$author->id}}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" id="name" name="name" class="form-control" value="{{$author->name}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning text-white text-bold shadow-sm">UPDATE</button>
            </div> --}}
        {{-- </form> --}}
        {!! Form::open(['action' => ['AuthorsController@update', $author->id],'method'=>'PUT','class'=>'card px-5 py-3 shadow rounded-lg w-auto']) !!}
            <div class="form-group">
                <label for="id">ID : </label>
                <input type="text" id="id" name="name" class="form-control" value="{{$author->id}}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" id="name" name="name" class="form-control" value="{{$author->name}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-warning text-white text-bold shadow-sm">UPDATE</button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection