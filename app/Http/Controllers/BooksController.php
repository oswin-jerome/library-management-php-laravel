<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Author;
use App\Category;
use App\Book;
use App\Transaction;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = 10;
        $categories = Category::all();
        $parms = $_GET;
        
        if(isset($_GET['submit'])){

            if($_GET['showCate']=='0'){
                $_GET['showCate'] ='';
            }
            $authors = [];
            if($_GET['key']=='author'){
                $aut = Author::where('name','LIKE','%'.$_GET['value'].'%')->get();
                foreach ($aut as $key => $value) {
                    array_push($authors,strval($value->id));
                }
                // print_r($authors);
                $books = Book::where([['category','LIKE','%'.$_GET['showCate'].'%']])->whereJsonContains('authors',$authors)->orderBy($_GET['filter'],$_GET['arrange'])->paginate($pages)->appends(request()->query());
                return view('pages.books.books',['books'=>$books,'parms'=>$parms,'categories'=>$categories]);
            }

            $books  = Book::where([[$_GET['key'],'LIKE','%'.$_GET['value'].'%'],['category','LIKE','%'.$_GET['showCate'].'%']])->orderBy($_GET['filter'],$_GET['arrange'])->paginate($pages)->appends(request()->query());
            return view('pages.books.books',['books'=>$books,'parms'=>$parms,'categories'=>$categories]);

        }else{
            $books = Book::paginate($pages);
            return view('pages.books.books',['books'=>$books,'categories'=>$categories,'parms'=>$parms]);
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
        $book->authors = $request['author'];
        $book->detials = $request['detials'];

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
        $members = Transaction::where('book_id','=',$id)->get();
        $book = Book::find($id);
        return view('pages.books.view',['book'=>$book,'members'=>$members]);
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
        $book->detials = $request['detials'];

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
