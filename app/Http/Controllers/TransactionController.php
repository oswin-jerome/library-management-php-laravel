<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Book;
use App\Member;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $members = Member::all();
        return view('pages.IssueBook.index',['books'=>$books,'members'=>$members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $book = Book::find($request->bookId);
        if($book->stock == 0)
            return redirect('issue_book')->with('error','Book not in stock');

        $transaction = new Transaction();
        $transaction->book_id = $request->bookId;
        $transaction->member_id = $request->memberID;
        $transaction->rented_at = date('Y-m-d H:i:s');
        // $transaction->returned_at = null;
        $transaction->isReturned = 0;

        $chk = $transaction->save();
        if($chk){

            $book = Book::find($request->bookId);
            $book->stock = 0;
            $book->save();

            return redirect('issue_book')->with('success','Book issued successfully');
        }else{
            return redirect('issue_book')->with('error','Error in issuing book');
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
        //
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
        $trans = Transaction::find($id);
        $trans->isReturned = 1;
        $trans->returned_at = date('Y-m-d H:i:s');
        $trans->save();

        $book = Book::find($trans->book_id);
        $book->stock = 1;
        $book->save();

        return redirect('members/'.$trans->member_id)->with('success','Book returned successfully');
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
