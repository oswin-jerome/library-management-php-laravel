<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Department;
use App\Member;
use Illuminate\Support\Facades\DB;
class GeneralController extends Controller
{
    public function pendingBooks(){

        $parms = $_GET;

        if(isset($_GET['submit'])){
            
            if($_GET['show']!='' ){

                if($_GET['show']=='all'){
                    $pendingBooks = Transaction::where('isReturned','=',0)->get();
                    $depts = Department::all();
                    return view('pages.issueBook.pendingBooks',['books'=>$pendingBooks,'departments'=>$depts,'parms'=>$parms,]);
                }

                // $members  = Member::where([[$_GET['key'],'LIKE','%'.$_GET['value'].'%'],['type','LIKE','%'.$_GET['showType'].'%'],['dept','LIKE','%'.$_GET['deptShow'].'%']])->orderBy($_GET['filter'],$_GET['arrange'])->paginate(15)->appends(request()->query());
                // return view('pages.members.members',['members'=>$members,'parms'=>$parms,'departments'=>$departments]);
                $members = Member::where('dept','=',$_GET['show'])->pluck('id')->toArray();
                // print_r($members);
                $pendingBooks = Transaction::where('isReturned','=',0)->whereIn('member_id',$members)->get();
                $depts = Department::all();
                return view('pages.issueBook.pendingBooks',['books'=>$pendingBooks,'departments'=>$depts,'parms'=>$parms,]);
            }

        }else{
            // $members = Member::paginate(15);
            // return view('pages.members.members',['members'=>$members,'departments'=>$departments,'parms'=>$parms,]);

            $pendingBooks = Transaction::where('isReturned','=',0)->get();
            $depts = Department::all();
            return view('pages.issueBook.pendingBooks',['books'=>$pendingBooks,'departments'=>$depts,'parms'=>$parms,]);
        }


        
    }
}
