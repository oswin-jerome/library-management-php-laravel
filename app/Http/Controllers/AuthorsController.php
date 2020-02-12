<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = 10; 
        $parms = $_GET;

        if(isset($_GET['submit'])){
            if($_GET['key'] =='id'){
                $authors  = Author::where('id','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate($pages)->appends(request()->query());
                return view('pages.authors.authors',['authors'=>$authors,'parms'=>$parms]);
            }
            if($_GET['key'] =='name'){
                $authors  = Author::where('name','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate($pages)->appends(request()->query());
                return view('pages.authors.authors',['authors'=>$authors,'parms'=>$parms]);
            }

        }else{
            $authors  = Author::paginate($pages);
        
            return view('pages.authors.authors',['authors'=>$authors,'parms'=>$parms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request['name'];
        $author->save();
        return redirect('authors/')->with('success','Author added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        $books = Book::whereJsonContains('authors',$id)->get();
        return view('pages.authors.view',['author'=>$author,'books'=>$books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author =  Author::find($id);
        return view('pages.Authors.edit',['author'=>$author]);
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
        $author =  Author::find($id);
        $author->name = $request['name'];
        $author->save();
        return redirect('authors')->with('warning','Author updated :-)');;
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
