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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Other projectRoute::get('/admin', 'HomeController@admin')->middleware('admin')->name('admin');

Route::get('/', 'HomeController@index')->name('home');

/*Route::get('topage', 'TopController@index1');*/
//Route::post('/topage', 'TestController@store');
//Route::get('/{topage}', 'TopController@search');

Route::get('/UserProfile', 'UserProfileController@index')->name('UserProfile');
Route::get('/CreateMainPage', 'MainPageController@index1')->name('CreateMainPage');
Route::get('/{main}/CreatePage',['as' => 'CreatePage' , 'uses' => 'PageController@index1']);
Route::get('/{main}/{page}/CreateTop',['as' => 'CreateTop' , 'uses' =>  'TopController@index1']);
Route::get('/{main}/{page}/AddMovieInDB',['as' => 'AddMovieInDB' , 'uses' =>  'MovieController@index']);
//dinamic :
Route::get('/{main}', 'MainPageController@index');
Route::get('/{main}/{slug}', 'PageController@index');
Route::get('/{main}/{slug}/{top}', 'TopController@index');


//store :
Route::post('/AddProfileInfo', ['uses'=> 'UserProfileController@store','as'=>'profileinfo.store' ]);
Route::post('/CreatePage', ['uses'=> 'PageController@store','as'=>'page.store' ]);
Route::post('/CreateTop', ['uses'=> 'TopController@store','as'=>'top.store' ]);
Route::post('/CreateMainPage', ['uses'=> 'MainPageController@store','as'=>'mainpage.store' ]);
Route::post('/{top_id}/comment' , ['uses'=> 'CommentController@store','as'=>'comment.store' ]);
Route::post('/{top_id}/{parent_id}/comment' , ['uses'=> 'CommentController@storereplay','as'=>'comment.storereplay' ]);
Route::post('/incrementvote' , 'CommentController@incrementvote');
Route::post('/decrementvote' , 'CommentController@decrementvote');
Route::delete('/deletecomment' , ['uses'=>'CommentController@deletecomment','as'=>'comment.delete' ]);
Route::put('/editcomment' , ['uses'=>'CommentController@editcomment','as'=>'comment.edit' ]);
Route::post('/incrementvotetop' , 'TopController@incrementvotetop');
Route::post('/decrementvotetop' , 'TopController@decrementvotetop');
Route::post('/StoreMovietTop', 'MovieController@store');
//Route::get('/comment1' , 'CommentController@showincrement' );
//edit/delete comments 
//Route::get('/comment/{id}/edit' , ['uses'=> 'CommentController@edit','as'=>'comment.edit' ]);
//Route::put('/comment/{id}', ['uses'=> 'CommentController@update','as'=>'comment.update' ]);
//Route::delete('/comment/{id}', ['uses'=> 'CommentController@destroy','as'=>'comment.destroy' ]);

