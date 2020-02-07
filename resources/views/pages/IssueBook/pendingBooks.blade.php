@extends('layouts.app')


@section('content')
    <div class="container-fluid mt-5">
        {{-- @isset($parms['show'])
            @if ($parms['show']=='all')
                <h1 class="text-center">Pending Books</h1>
            @else
                @foreach ($departments as $item)
                    @if ($item->id == $parms['show'])
                    <h1 class="text-center">Pending Books from {{$item->name}}</h1>
                    @endif
                @endforeach
            @endif
        @endisset
        @if (!isset($parms['show']))
            <h1 class="text-center">Pending Books</h1>
        @endif --}}
        
        <div class="search text-center mt-2 mb-4">
                    
            <i class="fas fa-search text-small text-black-50" id="toggleSearch1"></i>
        </div>
        {{Form::open(['action'=>'GeneralController@pendingBooks','method'=>'GET','class'=>'hide','id'=>'form'])}}
                <div class="row d-flex justify-content-center align-content-center align-items-center mt-3 shadow-sm border-0 p-1">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Show only </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="show">
                            <option @isset($parms['show']) @if ($parms['show']=='all') selected @endif @endisset value="all">All</option>
                            @foreach ($departments as $item)
                                <option @isset($parms['show']) @if ($parms['show']==$item->id) selected @endif @endisset value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- <div class="form-group ml-3">
                        <label for="exampleFormControlSelect13">Filter using : </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="filter">
                            <option @isset($parms['filter']) @if ($parms['filter']=='id') selected @endif @endisset value="id">ID</option>
                            <option @isset($parms['filter']) @if ($parms['filter']=='name') selected @endif @endisset value="name">Name</option>
                        </select>
                    </div>

                    <div class="form-group ml-3">
                        <label for="exampleFormControlSelect12">Filter using : </label>
                        <select class="form-control " id="exampleFormControlSelect1" name="arrange">
                            <option @isset($parms['arrange']) @if ($parms['arrange']=='asc') selected @endif @endisset value="asc">Assending</option>
                            <option @isset($parms['arrange']) @if ($parms['arrange']=='desc') selected @endif @endisset value="desc">Decending</option>
                        </select>
                    </div> --}}

                    <div class="form-group ml-4 mt-2">
                        <button type="submit" name="submit" value="search" class="btn btn-primary mt-4">Search</button>
                    </div>


                </div>
            {{Form::close()}}
        @if (count($books)>0)
                <div id="report">
                    @isset($parms['show'])
            @if ($parms['show']=='all')
                <h1 class="text-center">Pending Books</h1>
            @else
                @foreach ($departments as $item)
                    @if ($item->id == $parms['show'])
                    <h1 class="text-center">Pending Books from {{$item->name}}</h1>
                    @endif
                @endforeach
            @endif
        @endisset
        @if (!isset($parms['show']))
            <h1 class="text-center">Pending Books</h1>
        @endif
                    <table class="table table-borderless mt-5" id="bktr">
                        <thead class="text-white" style="background: #3f51b5">
                            <tr>
                                <th scope="col">Trans_ID</th>
                                <th scope="col">Book_Name</th>
                                <th scope="col">Rented_by</th>
                                <th scope="col">Department</th>
                                <th scope="col">Rented_at</th>
                                <th scope="col"></th>
                                {{-- <th scope="col">Returned at</th>
                                <th scope="col">Dept</th> --}}
                            </tr>
                        </thead>
            
                        <tbody>
                            @foreach ($books as $item)
                                <tr class="bg-white cust">
                                    <th scope="row">{{$item->id}}</th>
                                    <td><a href="/books/{{$item->book->id}}">{{$item->book->name}}</a></td>
                                    <td><a href="/members/{{$item->member->id}}">{{$item->member->name}}</a></td>
                                    <td><a href="/departments/{{$item->member->department->id}}">{{$item->member->department->name}}</a></td>
                                    <td>{{$item->rented_at}}</td>
                                    <td class="text-right" style="width:20% !important">
                                        {{-- <a href="#" class="btn btn-outline-primary btn-sm">Return</a> --}}
            
                                        {{Form::open(['action' => ['TransactionController@update', $item->id],'method'=>'PUT']) }}
                                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Return">
                                        {{ Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @else
            <h3 class="text-center mt-5">No Pending books</h3>
        @endif
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
        var el = document.getElementById('toggleSearch1');
        var elf = document.getElementById('form');
        el.addEventListener('click',()=>{
            elf.classList.toggle('hide');
        });
    </script>

    <div style="display: flex;justify-content: center">
        {{-- <input type="button" id="btnExport" value="Print" class="text-center btn btn-primary " /> --}}
        <input type="button" id="btnExport2" value="Generate Report" class="text-center btn btn-primary " />
    </div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#btnExport").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#bktr",
                schema: {
                    type: "table",
                    fields: {
                        Trans_ID: { type: String },
                        Book_Name: { type: String },
                        Department: { type: String },
                        Rented_by: { type: String },
                        Rented_at: { type: String }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "PrepBootstrap2",
                    created: new Date()
                });

                pdf.addPage("a4", "portrait");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "Trans_ID", title: "Trans ID" },
                        { field: "Book_Name", title: "Book Name",width:150 },
                        { field: "Rented_by", title: "Rented by",width:150},
                        { field: "Department", title: "Department",width:150},
                        { field: "Rented_at", title: "Rented at" }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "PrepBootstrapPDF"
                });
            });
        });
    });
</script>
<div id="grid" class="mt-4"></div>
<script type="text/javascript">
    jQuery(function ($) {
        $("#btnExport2").click(function(){
            var dataSource = shield.DataSource.create({
                data: "#bktr",
                schema: {
                    type: "table",
                    fields: {
                        Trans_ID: { type: String },
                        Book_Name: { type: String },
                        Department: { type: String },
                        Rented_by: { type: String },
                        Rented_at: { type: String }
                    }
                }
            });
            dataSource.read().then(function (data) {
                $("#grid").shieldGrid({
                    dataSource: {
                        data: data
                    },
                    paging: {
                        pageSize: 20,
                        pageLinksCount: 10
                    },
                    columns: [
                            { field: "Trans_ID", title: "Trans ID" },
                            { field: "Book_Name", title: "Book Name",width:150 },
                            { field: "Rented_by", title: "Rented by",width:150},
                            { field: "Department", title: "Department",width:70},
                            { field: "Rented_at", title: "Rented at" }
                    ],
                    toolbar: [
                        {
                            buttons: [
                                {
                                    commandName: "pdf",
                                    caption: '<span class="sui-sprite sui-grid-icon-export-excel"></span> <span class="sui-grid-button-text">Export to pdf</span>'
                                }
                            ]
                        }
                    ],
                    exportOptions: {
                        proxy: "/filesaver/save",
                        pdf: {
                            fileName: "pending books "+new Date().getDate()+" "+new Date().getMonth()+" "+new Date().getFullYear(),
                            author: "SJC",
                            dataSource: {
                                data: data
                            },
                            readDataSource: true,
                            margins: {
                                left: 30,
                                top: 50,
                                bottom: 10
                            }
                        }
                    }
                });
            });
        });
    });
</script>

@endsection