<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Book;
use App\Transaction;
use Illuminate\Support\Facades\DB;
// Charts
use App\Charts\MemberChart;
use App\Charts\BookChart;
class DashboardsController extends Controller
{
    
    function index () {

        // Charts
        lineChart();
        $memberChart = createMemberChart();
        $memberTypeChart = createMemberTypeChart();
        $bookInC =  createBooksInCategoryChart();
        $members = Member::count();
        $books = Book::count();
        $booksTaken = Transaction::count();
        $booksTr = Transaction::where('isReturned','=',0)->get();
        return view('pages.dashboard.dash',['total_members'=>$members,'total_books'=>$books,'booksTaken'=>$booksTaken,'btor'=>$booksTr,'memberChart'=>$memberChart,'memberTypeChart'=>$memberTypeChart,'bookInCategoryC'=>$bookInC]);
    }


    
}

function createMemberChart(){
    $mem = Member::select(DB::raw('count(*) as member_count,dept'))->groupBy("dept")->get();
    $ml = [];
    $md = [];
    foreach ($mem as $key => $value) {
        // echo($value);
        array_push($ml,$value->department->name);
        array_push($md,$value->member_count);
    }
    // echo($mem);
    $memberChart = new MemberChart;
    $memberChart->labels($ml);
    $memberChart->dataset('Number of members per department', 'bar', $md)->color("rgb(255, 99, 132)")
    ->backgroundcolor("rgb(255, 99, 132)");

    return $memberChart;
}

function createMemberTypeChart(){
    $mem = Member::select(DB::raw('count(*) as member_count,type'))->groupBy("type")->get();
    $ml = [];
    $md = [];
    foreach ($mem as $key => $value) {
        // echo($value);
        // array_push($ml,$value->type);
        if($value->type == 1){
            array_push($ml,"Student");
        }else{
            array_push($ml,"Staff");
        }
        array_push($md,$value->member_count);
    }
    // echo($mem);
    $memberChart = new MemberChart;
    $memberChart->labels($ml);
    $memberChart->displayaxes(false);
    $memberChart->dataset('', 'pie', $md)->color(["rgb(45, 108, 223)","rgba(255, 205, 86, 1)"])
    ->backgroundcolor(["rgb(45, 108, 223)","rgba(255, 205, 86, 1)"]);

    return $memberChart;
}

function createBooksInCategoryChart(){

    $borderColors = [
        "rgba(255, 99, 132, 1.0)",
        "rgba(22,160,133, 1.0)",
        "rgba(255, 205, 86, 1.0)",
        "rgba(51,105,232, 1.0)",
        "rgba(244,67,54, 1.0)",
        "rgba(34,198,246, 1.0)",
        "rgba(153, 102, 255, 1.0)",
        "rgba(255, 159, 64, 1.0)",
        "rgba(233,30,99, 1.0)",
        "rgba(205,220,57, 1.0)"
    ];
    $fillColors = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(22,160,133, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(51,105,232, 0.2)",
        "rgba(244,67,54, 0.2)",
        "rgba(34,198,246, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(233,30,99, 0.2)",
        "rgba(205,220,57, 0.2)"

    ];


    $books = Book::select(DB::raw('count(*) as count,category'))->groupBy("category")->get();
    $bl = [];
    $bd = [];

    foreach ($books as $key => $value) {
        // echo($value);
        array_push($bl,$value->cate->name);
        array_push($bd,$value->count);
    }
    $bookChart = new BookChart;
    // $bookChart->minimalist(false);
    $bookChart->labels($bl);
    // $bookChart->barWidth(0);
    $bookChart->dataset('No. of books per category', 'bar', $bd)->color($borderColors)
    ->backgroundcolor($borderColors);

    return $bookChart;
}


function lineChart(){
    $book = Book::select(DB::raw("count(*) as count,MONTH(created_at) as month"))->groupBy(DB::raw("MONTH(created_at)"))->whereRaw("YEAR(created_at) = 2020")->get();
    echo($book);
}