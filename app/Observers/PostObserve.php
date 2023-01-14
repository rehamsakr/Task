<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\UploadFiles;

class PostObserve
{

    use UploadFiles;

    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->author_id = auth()->id();
    }

    public function forceDeleted(Post $post)
    {
       $this->destroyFile($post->image);
    }

}
