<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardsController@index');
Route::get('/dashboard', 'DashboardsController@index');
Route::get('/pendingbooks','GeneralController@pendingBooks');

Route::resource('authors','AuthorsController');
Route::resource('categories','CategoriesController');
Route::resource('departments','DepartmentsController');
Route::resource('members','MembersController');
Route::resource('books','BooksController');
Route::resource('issue_book','TransactionController');
