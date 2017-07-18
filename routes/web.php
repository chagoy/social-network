<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile/{slug}',
		[
			'uses' => 'ProfilesController@index',
			'as' => 'profile'
	]);

	Route::get('/profile/a/edit', 
		[
			'uses' => 'ProfilesController@edit',
			'as' => 'profile.edit'
	]);

	Route::post('/profile/a/edit',
		[
			'uses' => 'ProfilesController@update',
			'as' => 'profile.update'
		]);

	Route::get('/check_relationships_status/{id}', [
			'uses' => 'FriendshipsController@check',
			'as' => 'check'
		]);

	Route::post('/add_friend/{id}', [
			'uses' => 'FriendshipsController@add_friend',
			'as' => 'add_friend'
		]);

	Route::post('/accept_friend/{id}', [
			'uses' => 'FriendshipsController@accept_friend',
			'as' => 'accept_friend'
		]);

	Route::get('/get_unread', function() {
		return Auth::user()->unreadNotifications;
	});

	Route::get('/notifications', [
		'uses' => 'HomeController@notifications',
		'as' => 'notifications'
	]);

	Route::post('/create/post', [
		'uses' => 'PostsController@store',
	]);

	Route::get('/feed', [
		'uses' => 'FeedsController@index',
		'as' => 'feed'
	]);

	Route::get('/get_auth_user_data', function (){
		return Auth::user();
	});

	Route::get('/like/{id}', [
		'uses' => 'LikesController@create'
	]);

	Route::get('/unlike/{id}', [
		'uses' => 'LikesController@destroy'
	]);
});