<?php

namespace App\Repository;

use App\Events\chatEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable ;

use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;

use App\Participant as myParticipant ;
use App\Thread as myThread ;
use App\Message as myMessage ;

use Illuminate\Pagination\Paginator;
use App\Notifications\InvoiceChat ;


class ChatRepositoryImpl implements ChatRepository
{
    // const columns of tables

    public function getUserChatList($userId)
    {
        // in handler exceptions --> handling not found token exception

        return Thread::forUser($userId)->latest(myThread::updatedAt)->get();

    }

    public function createNewThread($userId, $receiverId)
    {
        $receiver = User::find($receiverId) ;

        if (!$receiver) {

            abort(404 , "receiver user id not found");

        }

        $thread = Thread::create([
            MyThread::subject => $receiver->id . ' ' . $userId,
        ]);

        Participant::create([
            myParticipant::threadId => $thread->id,
            myParticipant::userId => $userId,
            myParticipant::lastRead => new Carbon,
        ]);

        Participant::create([
            myParticipant::threadId => $thread->id,
            myParticipant::userId  => $receiverId,
            myParticipant::lastRead => new Carbon,
        ]);

        return $thread;
    }

    public function getUserThreadInfo($threadId , $receiverId)
    {
        $user = User::find($receiverId) ;
       // $name = $user->{User::name};

        if (!$user) {

            abort(404 , "receiver user id not found");

        }

        $threadId = Thread::find($threadId);

        if (!$threadId) {

            abort(404 , "thread does not exist");

        }

        $message = array();

        $message['participants'] = Participant::where([
            [myParticipant::userId, '=', $receiverId],
            [myParticipant::threadId, '=', $threadId]
        ])->first();

        $message['userInfo'] = User::find($message['participants']->user_id)->first();

        return $message ;
    }

    public function getThreadMessages($threadId, $pages)
    {

        $messageQuery = Message::find($threadId)->orderBy(myMessage::id, 'DESC') ;

        if (!$messageQuery->first()) {

            abort(404 , "messages does not exist with this thread id");

        }

        Paginator::currentPageResolver(function() use ($pages) {

            return $pages;

        });

        $message = $messageQuery->paginate(15);

        return $message ;

    }

    public function sendNewMessage($userId, $threadId, $messageBody)
    {

        $message = Message::create([
            myMessage::threadId => $threadId,
            myMessage::userId => $userId,
            myMessage::body => $messageBody,
        ]);

        $userToSendNotification = Participant::where(
            [
                [myParticipant::threadId, '=', $threadId],
                [myParticipant::userId, '!=', $userId],
            ]
        )->get();

        $user = User::find($userToSendNotification[0]['user_id'])->first();

        if (!$user){

            abort(404 , "user does not exist");

        }

        event(new ChatEvent($messageBody , $user->id));

        // this comment is for slack and mail , database broadCasting notification

//        $when = now()->addMinutes(1);
//
//        $user->notify((new InvoiceChat($messageBody))->delay($when));

        return $message;
    }
}
