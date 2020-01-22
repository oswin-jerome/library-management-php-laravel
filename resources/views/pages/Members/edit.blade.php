@extends('layouts.app')


@section('content')
    <div id="createCate" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">
            {{Form::open(['action' => ['MembersController@update',$member->id],'method'=>'PUT',"class"=>"card px-5 py-3 shadow rounded-lg w-auto e border-0"])}}
                <h3 class="text-center  text-bold mb-5 mt-3 heading">Update a member</h3>
                
                
                
                <div class="form-group ">    
                    <label for="id">ID : </label>
                    <input type="text" id="id" name="id" class="form-control" value="{{$member->id}}" required>
                </div>

                <div class="form-group">    
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$member->name}}" required>
                </div>

            
                <div class="d-flex justify-content-center ">
                    <div class="form-group flex-grow-1">
                        <label for="exampleFormControlSelect1">Department : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="dept" required>

                            @if (count($departments)<1)
                                <option disabled>Create departments first</option>
                            @else
                                @foreach ($departments as $dept)
                                    <option @if ($member->dept == $dept->id) selected @endif value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group flex-grow-1 ml-2">
                        <label for="exampleFormControlSelect1">Type : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="type" required>
                            <option @if ($member->type == 1) selected @endif value="1">Student</option>
                            <option @if ($member->type == 2) selected @endif value="2">Staff</option>
                        </select>
                    </div>
                </div>

                    <div class="form-group w-100">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4" value="{{$member->email}}" required>
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