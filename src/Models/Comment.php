<?php

namespace Musonza\Groups\Models;

use Illuminate\Database\Eloquent\Model;
use Musonza\Groups\Traits\Likes;
use Musonza\Groups\Traits\Reporting;

class Comment extends Model
{
    use Likes;
    use Reporting;

    protected $fillable = ['post_id', 'user_id', 'body'];

    public function commentator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * Adds a comment.
     *
     * @param array $comment
     *
     * @return Comment
     */
    public function add($comment)
    {
        return $this->create($comment);
    }
}
