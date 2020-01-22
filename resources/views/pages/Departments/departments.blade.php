@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        

        <div class="list-container container">


                            <div class="search text-center mt-2">
                    
                    <i class="fas fa-search text-small text-black-50" id="toggleSearch"></i>
                </div>
                {{Form::open(['action'=>'DepartmentsController@index','method'=>'GET','class'=>'hide','id'=>'form'])}}
                <div class="row d-flex justify-content-center align-content-center align-items-center mt-3 shadow-sm border-0 p-1">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Find using : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="key">
                            <option @isset($parms['key']) @if ($parms['key']=='id') selected @endif @endisset value="id">ID</option>
                            <option @isset($parms['key']) @if ($parms['key']=='name') selected @endif @endisset value="name">Name</option>
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="ID">Value :</label>
                        <input @isset($parms['value']) value={{$parms['value']}} @endisset type="text" class="form-control" name="value" id="ID" required>
                    </div>


                    <div class="form-group ml-3">
                        <label for="exampleFormControlSelect1">Filter using : </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="filter">
                            <option @isset($parms['filter']) @if ($parms['filter']=='id') selected @endif @endisset value="id">ID</option>
                            <option @isset($parms['filter']) @if ($parms['filter']=='name') selected @endif @endisset value="name">Name</option>
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

            <table class="table table-borderless" id="myTable">
                <thead class="">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Department Name</th>
                    {{-- <th scope="col" class="contols">Controls</th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach ($departments as $department)
                        
                        <tr class="cust bg-white">
                            <th scope="row" class="">{{$department->id}}</th>
                            <td>{{$department->name}}</td>
                            <td class="contols">
                                <a href="/departments/{{$department->id}}/edit" class="btn-primary btn btn-sm mr-2"> <i class="fas fa-pencil-alt text-small"></i> &nbsp; Edit</a>
                                <a href="/departments/{{$department->id}}" class="btn-warning text-white btn btn-sm"> <i class="far fa-eye"></i> &nbsp; View</a>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
                </table>
            <div class="text-center justify-content-center d-flex mt-5">
                {{$departments}}
            </div>
            <div class="fab">
                <a href="departments/create/"><i class="fas fa-plus"></i></a>
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