<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Department;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parms = $_GET;
        $departments = Department::all();

        if(isset($_GET['submit'])){
            
            if($_GET['key']!='' ){
                if($_GET['showType']=='all'){
                    $_GET['showType'] ='';
                }
                if($_GET['deptShow']=='0'){
                    $_GET['deptShow'] ='';
                }
                $members  = Member::where([[$_GET['key'],'LIKE','%'.$_GET['value'].'%'],['type','LIKE','%'.$_GET['showType'].'%'],['dept','LIKE','%'.$_GET['deptShow'].'%']])->orderBy($_GET['filter'],$_GET['arrange'])->paginate(15)->appends(request()->query());
                return view('pages.members.members',['members'=>$members,'parms'=>$parms,'departments'=>$departments]);
            }

        }else{
            $members = Member::paginate(15);
            return view('pages.members.members',['members'=>$members,'departments'=>$departments,'parms'=>$parms,]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Department::all();

        return view('pages.members.create',['departments'=>$dept]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Member();
        $member->id = $request['id'];
        $member->name = $request['name'];
        $member->dept = $request['dept'];
        $member->type = $request['type'];
        $member->email = $request['email'];

        $chk = $member->save();

        if($chk){
            return redirect('members')->with('success','Member created successfully');
        }else{
            return redirect('members')->with('error','Error in creating member');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dept = Department::all();
        $member = Member::find($id);
        return view('pages.members.edit',['departments'=>$dept,'member'=>$member]);    
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
        $member = Member::find($id);
        $member->id = $request['id'];
        $member->name = $request['name'];
        $member->dept = $request['dept'];
        $member->type = $request['type'];
        $member->email = $request['email'];

        $chk = $member->save();

        if($chk){
            return redirect('members')->with('warning','Member updated successfully');
        }else{
            return redirect('members')->with('error','Error in updating member');
        }
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
