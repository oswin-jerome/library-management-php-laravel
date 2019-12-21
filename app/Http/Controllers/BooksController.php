<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Author;
use App\Category;
use App\Book;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $books = Book::paginate(15);
        return view('pages.books.books',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Department::all();
        $auth = Author::all();
        $cate = Category::all();
        
        return view('pages.books.create',['authors'=>$auth,'categories'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request['name'];
        $book->category = $request['category'];
        $book->author = $request['author'];

        $chk = $book->save();
        if($chk){
            return redirect('books')->with('success','Book created successfully');
        }else{
            return redirect('books')->with('error','Error in creating book');
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

        $auth = Author::all();
        $cate = Category::all();
        $book = Book::find($id);

        return view('pages.books.edit',['authors'=>$auth,'categories'=>$cate,'book'=>$book]);
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
        $book = Book::find($id);
        $book->name = $request['name'];
        $book->category = $request['category'];
        $book->author = $request['author'];

        $chk = $book->save();
        if($chk){
            return redirect('books')->with('warning','Book updated successfully');
        }else{
            return redirect('books')->with('error','Error in updating book');
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
