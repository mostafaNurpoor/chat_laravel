<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const id = 'id';

    const threadId = 'thread_id';

    const userId = 'user_id';

    const body = 'body';

    const createdAt = 'created_at';

    const updatedAt = 'updated_at';

    const deletedAt = 'deleted_at';
}
