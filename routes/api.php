<?php

Route::group([
    'prefix' => 'auth'

], function () {
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('user', 'AuthController@getAuthUser');
});


Route::group([
    'middleware' => ['jwt.verify', 'auth']
], function () {
Route::get('get-all-posts', 'PostController@getAllPosts');
Route::get('get-all-posts-by-user/{user_id}', 'PostController@getAllPostsByUser')->middleware('userPermission');
Route::post('add-new-post', 'PostController@addNewPost');
Route::get('get-post-by-id/{id}', 'PostController@getPostById');
Route::post('update-post', 'PostController@updatePost');
Route::post('delete-post/{id}', 'PostController@deletePost');
Route::post('check-is-user-reacted-post/{id}', 'PostController@isUserReactedPost');
Route::post('react-post/{id}', 'PostController@reactPost');
});
