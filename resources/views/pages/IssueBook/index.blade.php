@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <div id="issueBook" class="container-fluid d-flex justify-content-center align-items-center h-100 flex-column">

        {{-- {{Form::open(['action'=>'TransactionController@store','method'=>'POST','class'=>'card px-5 py-3 shadow rounded-lg w-50','id'=>'form'])}}
            {{-- <form action="" class="card px-5 py-3 shadow rounded-lg w-50"> --}}
                {{-- <h3 class="text-center  text-bold mb-5 mt-3 heading">Issue a book</h3>
                <div class="form-group">
                    <label for="bookId">Book ID</label>
                    <input type="text" class="form-control" id="bookId" name="bookId">
                    <small class="form-text " id="bookSts"></small>
                </div>
                <div class="form-group">
                    <label for="memberID">Member ID</label>
                    <input type="text" class="form-control" id="memberID" name="memberID">
                    <small class="form-text " id="memSts"></small>
                </div>

                <div class="text-center mb-2">
                    <button type="submit" id="ibs" class="btn btn-primary" name="submit">Issue book</button>
                </div> --}}
            {{-- </form> --}}
        {{-- {{Form::close()}} --}} 

        {{Form::open(['action'=>'TransactionController@store','method'=>'POST','class'=>'card px-5 py-3 shadow rounded-lg w-50 mt-3','id'=>'form2'])}}
            {{-- <form action="" class="card px-5 py-3 shadow rounded-lg w-50"> --}}
                <h3 class="text-center  text-bold mb-5 mt-3 heading">Issue a book</h3>
                <div class="form-group">
                    <label for="bookId2">Example select</label>
                    <select name="bookId" class="form-control" id="bookId2" required>
                        <option value selected disabled hidden>select a Book</option>
                        @foreach ($books as $book)
                            <option value={{$book->id}}>{{$book->name}} &nbsp;&nbsp;&nbsp;({{$book->id}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="memberID2">Example select</label>
                    <select name="memberID" class="form-control" id="memberID2" required>
                        <option value selected disabled hidden>select a Member</option>
                        @foreach ($members as $book)
                            <option value={{$book->id}}>{{$book->name}} &nbsp;&nbsp;&nbsp;({{$book->id}})</option>
                        @endforeach
                    </select>
                </div>
                  
                <div class="text-center mb-2">
                    <button type="submit" id="ibs2" class="btn btn-primary" name="submit">Issue book</button>
                </div>
            {{-- </form> --}}
        {{Form::close()}}

    </div>

    <style>
        .heading{
            font-weight: bold;
            color: rgba(0,0,0,0.35);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js" defer></script>
    <script>
        
        $(document).ready(()=>{

            $(function () {
  $("select").select2();
});
            var b1 = false;
            var b2 = false;
            $("#ibs").attr("disabled", true);

            $('#bookId').on('keyup',(s)=>{
                if($('#bookId').val()!=""){
                    jQuery.get("api/getbook/"+$('#bookId').val(), function(data, status){
                        if(status){
                            if(data.msg){
                                b1  =true;
                                console.log(data.data);
                                $('#bookSts').removeClass('text-danger');
                                $('#bookSts').text(data.data.name);
                                checkBtn();
                            }else{
                                b1 = false;
                                $('#bookSts').text("Book not found");
                                $('#bookSts').addClass('text-danger');
                                checkBtn();
                            }
                        }
                    });
                }
            });

            $('#memberID').on('keyup',(s)=>{
                if($('#memberID').val()!=""){
                    jQuery.get("api/getmember/"+$('#memberID').val(), function(data, status){
                        if(status){
                            var sta = "";
                            if(data.msg){
                                b2=true;
                                console.log(data.data);
                                $('#memSts').removeClass('text-danger');
                                $('#memSts').text(data.data.name);
                                checkBtn();
                            }else{
                                b3=false;
                                $('#memSts').text("Member not found");
                                $('#memSts').addClass('text-danger');
                                checkBtn();
                            }
                        }
                    });
                }
            });


            function checkBtn(){
                if(b1 && b2){
                    $("#ibs").attr("disabled", false);
                }else{
                    $("#ibs").attr("disabled", true);
                }
            }

        });
    </script>
@endsection