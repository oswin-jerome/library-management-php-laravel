<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books',function(Request $request){
    $books = App\Book::all();
    $b = [];
    foreach ($books as $value) {
        $category = App\Category::find($value['category']);
        $value['category'] = $category;
        array_push($b,$value);
    }
    return $b;
});
// Route::get('/',function(Request $request){
    
//     $to_name = 'User';
//     $to_email = 'oswinsherwin@gmail.com';
//     $data = array('name'=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");
//     Mail::send('emails.user', $data, function($message) use ($to_name, $to_email) {
//     $message->to($to_email, $to_name)
//     ->subject('Laravel Test Mail');
//     $message->from('oswinjeromej@gmail.com','Test Mail');
//     });

// });



Route::get('/getbook/{id}',function($id){

    $book = App\Book::find($id);

    if($book){
        return ['data'=>$book,'msg'=>true];
    }else{
        return ['msg'=>false];
    }
});
Route::get('/getmember/{id}',function($id){

    $book = App\Member::find($id);

    if($book){
        return ['data'=>$book,'msg'=>true];
    }else{
        return ['msg'=>false];
    }
});