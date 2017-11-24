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
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('frontend.portfolio.index');
});

Route::get('/admin', function(){
	return view('backend.admin.login');
});

Route::get('/verify-email/{token}', 'Auth\RegisterController@verify');

Route::get('/test-repo', 'Backend\Admin\UserController@testRepo');

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

   //resource generates all the needed routes for that controller, see documentation for more..
   Route::resource('users', 'Backend\Admin\UserController');
   //$this->get('/users', 'Backend\Admin\UserController@index');
   $this->get('/users/{id}/delete', 'Backend\Admin\UserController@destroy');

   $this->post('/users/update/{id}', 'Backend\Admin\UserController@update');

   //datatable post route definition for user management
   $this->post('/get-users/', 'Backend\Admin\UserController@getAll');
   // $this->get('/users/{id}/edit', 'Backend\Admin\UserController@edit');

   //for portfolio routes
   Route::resource('portfolio/about-me', 'Backend\Admin\Portfolio\AboutMeController');

   Route::resource('portfolio/education', 'Backend\Admin\Portfolio\EducationController');

   Route::resource('portfolio/experience', 'Backend\Admin\Portfolio\ExperienceController');

   Route::resource('portfolio/expertise', 'Backend\Admin\Portfolio\ExpertiseController');

   Route::resource('portfolio/skill', 'Backend\Admin\Portfolio\SkillController');

   Route::resource('portfolio/contact', 'Backend\Admin\Portfolio\ContactController');

   //uses laravel's default logout routes
   
   $this->get('/logout', 'Auth\LoginController@logout')->name('logout');

   /*Route::get('/secret-cookie', function() {

	$response = new Illuminate\Http\Response('Cookie installed');

	$response->withCookie(cookie()->forever('secret-cookie', 'peter'));

	return $response;
	});*/

   Route::get('/up', function() {
    \Artisan::call('up');

     Session::flash('flash_message', 'Your site is live now!');

	    return back();
	});

	Route::get('/down', function() {

		$response = new Illuminate\Http\Response('Cookie installed');

		$response->withCookie(cookie()->forever('secret-cookie', 'peter'));

	    Session::flash('flash_message', 'Your site is in maintenance mode!');

	    \Artisan::call('down');

	    return back()->with(compact('response'));
	});
   
});
// Registration Routes...

//$this->get('console/register', 'Auth\RegisterController@showRegisterForm')->name('register');

Route::get('/run-shell-command', function() {
    $output = shell_exec('ls');
    echo "<pre>$output</pre>";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
