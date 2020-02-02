<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'messages' , 'middleware' => 'auth:api'], function () {

    Route::get('/threads', 'MessageController@getChatList');                           // get chat list

    Route::post('/threads', 'MessageController@startNewChat');                          // create chat with user by userId

    Route::get('/threads/{id}', 'MessageController@userThreadInfo');                     // chat info for that user

    Route::get('/threads/{id}/messages/{pages}', 'MessageController@getThreadMessages'); // get user messages in chat by pagination

    Route::post('/threads/{id}/messages', 'MessageController@sendMessage');            // send new message

});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@logIn');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@userData');
    });
});

