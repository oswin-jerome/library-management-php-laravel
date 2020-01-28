<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Member;
use App\Transaction;
class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $parms = $_GET;

        if(isset($_GET['submit'])){
            if($_GET['key'] =='id'){
                $departments  = Department::where('id','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate(15)->appends(request()->query());
                return view('pages.departments.departments',['departments'=>$departments,'parms'=>$parms]);
            }
            if($_GET['key'] =='name'){
                $departments  = Department::where('name','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate(15)->appends(request()->query());
                return view('pages.departments.departments',['departments'=>$departments,'parms'=>$parms]);
            }

        }else{
            $departments  = Department::paginate(15);
        
            return view('pages.departments.departments',['departments'=>$departments,'parms'=>$parms]);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new Department();
        $department->name = $request['name'];
        $department->save();

        return redirect('departments')->with('success','Department added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        $members = Member::where('dept','=',$id)->get();
        $memberIDS = [];
        foreach ($members as $key => $value) {
            
            array_push($memberIDS,$value->id);
        }
        $books = Transaction::whereIn('member_id',$memberIDS)->get();

        // print_r($books);        

        return view('pages.departments.view',['department'=>$department,'members'=>$members,'books'=>$books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return view('pages.departments.edit',['department'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->name = $request['name'];
        $department->save();

        return redirect('departments')->with('warning','Department updated :-)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
