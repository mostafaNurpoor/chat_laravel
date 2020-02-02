<?php

namespace App\Http\Controllers;

use App\Repository\ChatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\GeneralResponse ;

class MessageController extends Controller
{
    protected $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function getChatList(Request $request)
    {
        $chatList = $this->chatRepository->getUserChatList(Auth::id());

        return GeneralResponse::success($chatList) ;
    }

    public function startNewChat(Request $request)
    {
//        $request->validate([
//            'receiver_id ' => 'required',
//            'type ' => 'required',
//        ]);

        $newThread = $this->chatRepository->createNewThread(Auth::id(), $request->receiver_id);

        return GeneralResponse::success($newThread) ;

    }

    public function userThreadInfo($threadId , Request $request)
    {
//        $request->validate([
//            'receiver_id ' => 'required',
//        ]);

        $userChatInfo = $this->chatRepository->getUserThreadInfo($threadId , $request->receiver_id);

        return GeneralResponse::success($userChatInfo) ;

    }

    public function getThreadMessages($threadId , $pages)
    {
        $messages = $this->chatRepository->getThreadMessages($threadId , $pages);

        return GeneralResponse::success($messages) ;
    }

    public function sendMessage($threadId , Request $request)
    {
//        $request->validate([
//            'message_body ' => 'required',
//        ]);

        $sendNewMessage = $this->chatRepository->sendNewMessage(Auth::id() , $threadId , $request->message_body);

        return GeneralResponse::success($sendNewMessage) ;
    }

}
