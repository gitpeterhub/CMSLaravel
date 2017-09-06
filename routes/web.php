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

Route::get('/admin', function(){
	return view('backend.admin.login');
});

Route::get('/admin/register', function(){
	return view('backend.admin.register');
});

Route::get('/admin/dashboard', function(){
	return view('backend.admin.dashboardv1');
});

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