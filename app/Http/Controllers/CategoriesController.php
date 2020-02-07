<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parms = $_GET;

        if(isset($_GET['submit'])){
            if($_GET['key'] =='id'){
                $categories  = Category::where('id','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate(10)->appends(request()->query());
                return view('pages.categories.categories',['categories'=>$categories,'parms'=>$parms]);
            }
            if($_GET['key'] =='name'){
                $categories  = Category::where('name','LIKE','%'.$_GET['value'].'%')->orderBy($_GET['filter'],$_GET['arrange'])->paginate(10)->appends(request()->query());
                return view('pages.categories.categories',['categories'=>$categories,'parms'=>$parms]);
            }

        }else{
            $categories  = Category::paginate(10);
        
            return view('pages.categories.categories',['categories'=>$categories,'parms'=>$parms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->save();

        return redirect('categories')->with('success','Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Book::where('category','=',$id)->get();
        $category = Category::find($id);
        return view('pages.categories.view',['books'=>$books,'category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages.categories.edit',['category'=>$category]);
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
        $category = Category::find($id);
        $category->name = $request['name'];
        $category->save();

        return redirect('categories')->with('warning','Category updated :-)');
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
