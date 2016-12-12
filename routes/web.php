<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => ['web']], function(){
	// Authentication Routes
	Route::get('auth/login', [ 
		'uses' => 'Auth\LoginController@showLoginForm',
		'as' => 'login'
		]);
	Route::post('auth/login', 'Auth\LoginController@login');
	Route::get('auth/logout', [
		'uses' => 'Auth\LoginController@logout',
		'as' => 'logout'
		]);

	//Registrations Routes
	Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
	Route::post('auth/register', 'Auth\RegisterController@register');

	
	Route::get('blog/{slug}', [ 
		'uses' => 'BlogController@getSingle', 
		'as' => 'blog.single'])->where('slug', '[\w\d\-\_]+');
	// /w = any word character, /d = any number character, + = Howevermany any characters i.e restricting to just these characters
	// The above means regular expressions

	Route::get('blog', [
		'uses' => 'BlogController@getIndex',
		'as' => 'blog.index'
	]);

	// Categories
	Route::resource('categories', 'CategoryController', ['except' => ['create']]);

	//Comments
	Route::post('comments/{post_id}', [
		'uses' => 'CommentsController@store',
		'as' => 'comments.store'
		]);

	Route::get('comments/{id}/edit', [
		'uses' => 'CommentsController@edit',
		'as' => 'comments.edit'
		]);

	Route::put('comments/{id}', [
		'uses' => 'CommentsController@update',
		'as' => 'comments.update'
		]);

	Route::delete('comments/{id}', [
		'uses' => 'CommentsController@destroy',
		'as' => 'comments.destroy'
		]);


	Route::get('comments/{id}/delete', [
		'uses' => 'CommentsController@delete',
		'as' => 'comments.delete'
		]);



	// Tags
	Route::resource('tags', 'TagController', ['except' => ['create']]);


	Route::get('/contact', 'PagesController@getContact');

	Route::post('/contact', 'PagesController@postContact');

	Route::get('/about', 'PagesController@getAbout');


	Route::get('/', 'PagesController@getIndex');

	Route::resource('/posts', 'PostController');

	Auth::routes();

	Route::get('/welcome', 'HomeController@index');
});



