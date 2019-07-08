<?php

namespace Musonza\Groups\Traits;

use Musonza\Groups\Models\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
