<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chatChannel.{channelId}', function ($user , $userId) {
    //return true ;
    return \Illuminate\Support\Facades\Auth::check() ;
});


//Broadcast::channel('online', function ($user) {
//    if (auth()->check()) {
//        return $user->toArray();
//    }
//});
