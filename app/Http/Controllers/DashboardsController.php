<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Book;
class DashboardsController extends Controller
{
    function index () {
        $members = Member::count();
        $books = Book::count();
        return view('pages.dashboard.dash',['total_members'=>$members,'total_books'=>$books]);
    }
}
