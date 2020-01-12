<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Book;
use App\Transaction;
class DashboardsController extends Controller
{
    function index () {
        $members = Member::count();
        $books = Book::count();
        $booksTaken = Transaction::count();
        return view('pages.dashboard.dash',['total_members'=>$members,'total_books'=>$books,'booksTaken'=>$booksTaken]);
    }
}
