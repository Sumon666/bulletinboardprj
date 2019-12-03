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
Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('welcome');
});

//home
Route::get('/home', 'HomeController@index')->name('home');

//login
Route::get('/', function () {
    return view('auth.login');
});
Route::post('login', 'Auth\LoginController@login');

//post & postconfirm
Route::get('/post', function () {
    return view('post.post');
});
Route::get('/clearpost', 'PostController@clearPost');
Route::get('/postvalidate', 'PostController@showPost');
Route::get('/cancelpost', 'PostController@cancelPost');
Route::post('/postconfirm', 'PostController@store');

//postlist
Route::get('/postlist', 'PostController@getPostList');
//searchpost
Route::any('/searchpost', 'PostController@getPostList');
//postupdate
Route::get('/postupdate', function () {
    return view('post.postupdate');
});
//deletepost
Route::any('/deletepost/{id}', 'PostController@delete');
//uploadCSV
Route::get('/uploadcsv', function () {
    return view('csv.uploadcsv');
});
Route::post('/uploadcsv', 'PostController@uploadCSV');
//download
Route::get('/downloadexcel', 'PostController@downloadExcel');
//postDetail
Route::get('/postdetail/{title}', 'PostController@getPostDetail');

//postupdate & updateconfirm
Route::get('/clearupdatepost', 'PostUpdateController@clearUpdatePost');
Route::get('/postupdate/{id}', 'PostUpdateController@showUpdatePost');
Route::get('/cancelupdate', 'PostUpdateController@cancelUpdate');
Route::get('/postupdateconfirm', 'PostUpdateController@checkUpdatePost');
Route::post('/updatedata', 'PostUpdateController@updatePost');

//user & userconfirm
Route::get('/usercreate', function () {
    return view('user.usercreate');
});
Route::get('/clearuserinfo', 'UserController@clearUserData');
Route::post('/uservalidate', 'UserController@showUserData');
Route::get('/canceldata', 'UserController@cancelUserData');
Route::post('/adduser', 'UserController@store');
Route::get('/userconfirm', function () {
    return view('user.userconfirm');
});

//userlist
Route::get('/userlist', 'UserController@getUserList');
Route::group(['middleware' => ['admin']], function () {
    //searchlist
    Route::any('/searchuser', 'UserController@getUserList');
});
Route::any('/deleteuser/{id}', 'UserController@delete');
Route::get('/userdetail/{name}', 'UserController@getUserDetail');

//user update
Route::get('/userupdate', function () {
    return view('user.userupdate');
});
Route::get('/userupdateconfirm', function () {
    return view('user.userupdateconfirm');
});
Route::get('/userupdate/{id}', 'UserUpdateController@showUpdateUser');
Route::get('/clearuseredit', 'UserUpdateController@clearUpdateData');
Route::post('/updatevalidate', 'UserUpdateController@showUpdateConfirm');
Route::get('/cancelupdatedata', 'UserUpdateController@cancelUpdateData');
Route::post('/updateuserdata', 'UserUpdateController@updateUserData');

//changepassword
Route::get('/changepassword', function () {
    return view('auth.changepassword');
});
Route::post('/passwordvalidate', 'HomeController@checkPassword');
Route::get('/clearpassword', 'HomeController@clearPassword');

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
