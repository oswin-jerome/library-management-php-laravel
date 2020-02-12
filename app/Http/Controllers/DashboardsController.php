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
        // randomColors();
        // Charts
        $booksAddedChart = lineChartBooksAdded();
        $TransactionChart = lineChartTrasaction();
        $TransactionChartRtn = lineChartTrasactionRtn();
        $membersBooksAddedChart = lineChartMembersAdded();
        $memberChart = createMemberChart();
        $memberTypeChart = createMemberTypeChart();
        $bookInC =  createBooksInCategoryChart();
        $members = Member::count();
        $books = Book::count();
        $booksTaken = Transaction::count();
        $booksTr = Transaction::where('isReturned','=',0)->get();
        return view('pages.dashboard.dash',['total_members'=>$members,'total_books'=>$books,'booksTaken'=>$booksTaken,'btor'=>$booksTr,
        'memberChart'=>$memberChart,'memberTypeChart'=>$memberTypeChart,'bookInCategoryC'=>$bookInC,"membersAddedChart"=>$membersBooksAddedChart,
        'booksAddedChart'=>$booksAddedChart,'TransactionChart'=>$TransactionChart,'transRtnChart'=>$TransactionChartRtn]);
    }


    
}

function createMemberChart(){
    $mem = Member::select(DB::raw('count(*) as member_count,dept'))->groupBy("dept")->get();
    $ml = [];
    $md = [];
    $colors = [];
    foreach ($mem as $key => $value) {
        // echo($value);
        array_push($ml,$value->department->name);
        array_push($md,$value->member_count);
    }
    // echo($mem);
    $memberChart = new MemberChart;
    $memberChart->labels($ml);
    $memberChart->dataset('Number of members per department', 'bar', $md)->color("rgba(48,63,159,1)")
    ->backgroundcolor("rgba(48,63,159,0.6)");

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
    $bookChart->dataset('No. of books per category', 'bar', $bd)->color("rgba(0,150,136,1)")
    ->backgroundcolor("rgba(0,150,136,0.6)");

    return $bookChart;
}


function lineChartBooksAdded(){
    $currentYear = date("Y");

    $booksAdded = Book::select(DB::raw("count(*) as count,MONTH(created_at) as month,YEAR(created_at) as year"))->groupBy(DB::raw("MONTH(created_at),YEAR(created_at)"))
    ->whereRaw("YEAR(created_at) IN (?,?,?)",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(created_at),MONTH(created_at)')->get();
    // echo($booksAdded);
    $bookAddedLable = [];
    $bookAddedData = [];

    foreach ($booksAdded as $key => $value) {
        // echo(numberToMonth($value->month).$value->year);
        array_push($bookAddedLable,numberToMonth($value->month).$value->year);
        array_push($bookAddedData,$value->count);
    }

    $bookChart = new BookChart;
    $bookChart->labels($bookAddedLable);
    // $bookChart->displaylegend(false);
    $bookChart->dataset('Books Added', 'line', $bookAddedData)->color("rgba(33,150,243,1)")
    ->backgroundcolor("rgba(33,150,243,0.4)");
    
    return $bookChart;
}

function lineChartMembersAdded(){
    $currentYear = date("Y");

    $membersAdded = Member::select(DB::raw("count(*) as count,MONTH(created_at) as month,YEAR(created_at) as year"))->groupBy(DB::raw("MONTH(created_at),YEAR(created_at)"))
    ->whereRaw("YEAR(created_at) IN (?,?,?)",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(created_at),MONTH(created_at)')->get();
    // echo($membersAdded);
    $bookAddedLable = [];
    $bookAddedData = [];

    foreach ($membersAdded as $key => $value) {
        // echo(numberToMonth($value->month).$value->year);
        array_push($bookAddedLable,numberToMonth($value->month).$value->year);
        array_push($bookAddedData,$value->count);
    }

    $bookChart = new BookChart;
    // $bookChart->minimalist(true);
    $bookChart->labels(["s","sd","sss"]);
    $bookChart->labels($bookAddedLable);
    // $bookChart->displaylegend(false);
    $bookChart->dataset('Members Added', 'line', $bookAddedData)->color("rgba(255,87,34,1)")
    ->backgroundcolor("rgba(255,87,34,0.4)");
    
    return $bookChart;
}

function lineChartTrasaction(){
    $currentYear = date("Y");

    $trans = Transaction::select(DB::raw("count(*) as count,MONTH(rented_at) as month,YEAR(rented_at) as year"))->groupBy(DB::raw("MONTH(rented_at),YEAR(rented_at)"))
    ->whereRaw("YEAR(rented_at) IN (?,?,?)",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(rented_at),MONTH(rented_at)')->get();

    $rtm = Transaction::select(DB::raw("count(*) as count,MONTH(returned_at) as month,YEAR(returned_at) as year"))->groupBy(DB::raw("MONTH(returned_at),YEAR(returned_at)"))
    ->whereRaw("YEAR(returned_at) IN (?,?,?) AND isReturned = 1 ",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(returned_at),MONTH(returned_at)')->get();
    // echo($trans);
    $bookAddedLable = [];
    $bookAddedData = [];

    foreach ($trans as $key => $value) {
        // echo(numberToMonth($value->month).$value->year);
        array_push($bookAddedLable,numberToMonth($value->month).$value->year);
        array_push($bookAddedData,$value->count);
    }

    $bookChart = new BookChart;
    // $bookChart->minimalist(true);
    // $bookChart->labels(["s","sd","sss"]);
    $bookChart->labels($bookAddedLable);
    // $bookChart->displaylegend(false);
    $bookChart->dataset('Books Rented', 'line', $bookAddedData)->color("rgba(103,58,183,1)")
    ->backgroundcolor("rgba(103,58,183,0.4)");
    
    return $bookChart;
}
function lineChartTrasactionRtn(){
    $currentYear = date("Y");

    $transd = Transaction::select(DB::raw("count(*) as count,MONTH(rented_at) as month,YEAR(rented_at) as year"))->groupBy(DB::raw("MONTH(rented_at),YEAR(rented_at)"))
    ->whereRaw("YEAR(rented_at) IN (?,?,?)",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(rented_at),MONTH(rented_at)')->get();

    $trans = Transaction::select(DB::raw("count(*) as count,MONTH(returned_at) as month,YEAR(returned_at) as year"))->groupBy(DB::raw("MONTH(returned_at),YEAR(returned_at)"))
    ->whereRaw("YEAR(returned_at) IN (?,?,?) AND isReturned = 1 ",[$currentYear-1,$currentYear,$currentYear+1])->orderByRaw('YEAR(returned_at),MONTH(returned_at)')->get();
    // echo($trans);
    $bookAddedLable = [];
    $bookAddedData = [];

    foreach ($trans as $key => $value) {
        // echo(numberToMonth($value->month).$value->year);
        array_push($bookAddedLable,numberToMonth($value->month).$value->year);
        array_push($bookAddedData,$value->count);
    }

    $bookChart = new BookChart;
    // $bookChart->minimalist(true);
    // $bookChart->labels(["s","sd","sss"]);
    $bookChart->labels($bookAddedLable);
    // $bookChart->displaylegend(false);
    $bookChart->dataset('Books Returned', 'line', $bookAddedData)->color("rgba(76,175,80,1)")
    ->backgroundcolor("rgba(76,175,80,0.4)");
    
    return $bookChart;
}





function numberToMonth($n){
    if($n<1){
        return "NILL";
    }
    if($n>12){
        return "NILL";
    }
    $months = [
        "January ",
        "February ",
        "March ",
        "April ",
        "May ",
        "June ",
        "July ",
        "August ",
        "September ",
        "October ",
        "November ",
        "December "

    ];

    return $months[$n-1];
}


function randomColors(){
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
    echo(rand(0,sizeof($borderColors)-1));
    // print_r(sizeof($borderColors));

    return $borderColors[rand(0,sizeof($borderColors)-1)];
}