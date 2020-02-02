<?php

namespace App\Repository;

interface ChatRepository
{
    public function getUserChatList(int $userId);

    public function createNewThread(int $userId, int $receiverId);

    public function getUserThreadInfo(int $threadId , int $userId);

    public function getThreadMessages(int $threadId, int $pages);

    public function sendNewMessage(int $userId, int $threadId, $messageBody);
}
