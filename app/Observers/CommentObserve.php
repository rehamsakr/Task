<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserve
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->user_id = auth()->id();
    }
}
