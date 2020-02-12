@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

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
                <div class="form-group">    
                    <label for="detials">Detials : </label>
                    <input type="text" id="detials" name="detials" class="form-control" required>
                </div>

            
                <div class="d-flex justify-content-center mt-3 ">
                    <div class="form-group flex-grow-1">
                        <label for="exampleFormControlSelect1">Author : </label>
                        <select class="form-control" id="exampleFormControlSelect1" placeholder="sdsd" name="author[]" multiple required>

                            @if (count($authors)<1)
                                {{-- <option disabled>Create authors first</option> --}}
                            @else
                            {{-- <option value selected disabled hidden>select a Author</option> --}}
                                @foreach ($authors as $dept)
                                    <option value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group flex-grow-1 ml-2">
                        <label for="exampleFormControlSelect2">Category : </label>
                        <select class="form-control" id="exampleFormControlSelect2" name="category" required>
                            @if (count($categories)<1)
                                <option disabled>Create categoried first</option>
                            @else
                            <option value selected disabled hidden>select a Category</option>
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
                select option{
                    margin: 15px !important;
                }
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

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js" defer></script>

<script>
    $(document).ready(()=>{
        $(function () {
  $("select").select2();
});
    });
</script>
@endsection