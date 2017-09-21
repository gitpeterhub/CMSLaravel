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

Route::get('/admin/login', function(){
	return view('backend.admin.login');
})->name('login');

Route::get('/admin/register', function(){
	return view('backend.admin.register');
})->name('register');

Route::post('/admin/register', 'Auth\RegisterController@register');

Route::get('/admin/dashboardv2', function(){
	return view('backend.admin.dashboardv2');
});

Route::get('/admin/calendar', function(){
	return view('backend.admin.calendar');
});

Route::get('/admin/mailbox', function(){
	return view('backend.admin.mailbox');
});

Route::get('/admin/compose-mail', function(){
	return view('backend.admin.compose-mail');
});

Route::get('/admin/read-mail', function(){
	return view('backend.admin.read-mail');
});


Route::post('login', 'Auth\LoginController@login');

//Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

Route::group(['prefix' => '/admin',  'middleware' => 'auth'], function()
{
	//Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
   $this->get('/dashboard', 'Backend\Admin\DashboardController@index')->name('dashboard');

   $this->get('/user-management', 'Backend\Admin\UserController@index');
   $this->post('/users', 'Backend\Admin\UserController@getAll');

   //uses laravel's default logout routes
   
   $this->get('/logout', 'Auth\LoginController@logout')->name('logout');
   
});
// Registration Routes...

//$this->get('console/register', 'Auth\RegisterController@showRegisterForm')->name('register');

