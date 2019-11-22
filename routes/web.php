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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//login
Route::get('/', function () {
    return view('auth.login');
});
Route::post('login','Auth\LoginController@login');

//post
Route::get('/post', function () {
    return view('post.post');
});

//postupdate & postconfirm
Route::get('/postupdate', function () {
    return view('post.postupdate');
});

//postconfirm
Route::get('/clearPost', 'PostController@clearpost');
Route::get('/postvalidate', 'PostController@show');
Route::get('/cancelPost', 'PostController@cancelpost');
//store post
Route::post('/postconfirm', 'PostController@store');

//postlist
Route::get('/postlist', 'PostController@getPostList');
//searchlist
Route::any('/searchPost', 'PostController@getPostList');
//deletepost
Route::any('/deletePost/{id}', 'PostController@delete');
//uploadCSV
Route::post('/uploadCSV', 'PostController@uploadCSV');
//download
Route::get('/downloadExcel', 'PostController@downloadExcel');
//postDetail
Route::get('/postDetail/{title}', 'PostController@getPostDetail');

Route::get('/clearPostUpdate', 'PostUpdateController@clearpost');
Route::get('/postupdate/{id}', 'PostUpdateController@show');
Route::get('/cancelupdate', 'PostUpdateController@cancelupdate');
Route::get('/postupdateconfirm', 'PostUpdateController@confirm');
Route::post('/updatedata', 'PostUpdateController@update');

//user
Route::get('/usercreate', function () {
    return view('user.usercreate');
});

Route::get('/clearuserinfo', 'UserController@clearuser');
Route::post('/uservalidate', 'UserController@show');
Route::get('/canceldata', 'UserController@canceldata');
Route::post('/adduser', 'UserController@store');

//userconfirm
Route::get('/userconfirm', function () {
    return view('user.userconfirm');
});

//userlist
Route::get('/userlist', 'UserController@getUserList');
Route::group(['middleware' => ['admin']], function () {
    //searchlist
    Route::any('/searchUser', 'UserController@getUserList');
});

//deleteuser
Route::any('/deleteUser/{id}', 'UserController@delete');
//postDetail
Route::get('/userDetail/{name}', 'UserController@getUserDetail');

Route::get('/userupdate', function () {
    return view('user.userupdate');
});
Route::get('/userupdate/{id}', 'UserUpdateController@updateshow');
Route::get('/clearuseredit', 'UserUpdateController@clearuser');
Route::post('/updatevalidate', 'UserUpdateController@updateconfirm');
Route::get('/cancelupdatedata', 'UserUpdateController@canceleditdata');
Route::post('/updateuserdata', 'UserUpdateController@update');

Route::get('/userupdateconfirm', function () {
    return view('user.userupdateconfirm');
});

//changepassword
Route::get('/changePassword', function () {
    return view('auth.changepassword');
});
Route::post('/passwordvalidate','HomeController@checkpassword');
Route::get('/clearpassword', 'HomeController@clearpassword');

//user profile
Route::get('/userprofile', function () {
    return view('user.userprofile');
});

//password reset and verify email
Route::get('/email', function () {
    return view('auth.passwords.email');
});
Route::get('/reset/{token}', function () {
    return view('auth.passwords.reset');
});

Route::get('/uploadcsv', function () {
    return view('csv.uploadcsv');
});

