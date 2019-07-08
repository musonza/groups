<?php

namespace Musonza\Groups;

use Musonza\Groups\Models\Comment;
use Musonza\Groups\Models\Group;
use Musonza\Groups\Models\Post;
use Musonza\Groups\Models\User;

class Groups
{
    /**
     * @var Comment
     */
    protected $comment;
    /**
     * @var Group
     */
    protected $group;
    /**
     * @var Post
     */
    protected $post;
    /**
     * @var User
     */
    protected $user;

    public function __construct(Comment $comment, Group $group, Post $post)
    {
        $this->comment = $comment;
        $this->group = $group;
        $this->post = $post;
        $this->user = app(self::userModel());
    }

    public static function userModel()
    {
        return config('musonza_groups.user_model', User::class);
    }

    /**
     * Returns User instance with group relation.
     *
     * @param int $userId
     *
     * @return User
     */
    public function getUser($userId)
    {
        return $this->user->find($userId);
    }

    /**
     * Creates a group.
     *
     * @param int   $userId owner of group
     * @param array $data    group information
     *
     * @return Group
     */
    public function create($userId, $data)
    {
        return $this->group->make($userId, $data);
    }

    /**
     * Returns a group.
     *
     * @param int $groupId
     *
     * @return Group
     */
    public function group($groupId)
    {
        return $this->group->findOrFail($groupId);
    }

    /**
     * Creates a post.
     *
     * @param array $data
     *
     * @return Post
     */
    public function createPost($data)
    {
        return $this->post->make($data);
    }

    /**
     * Returns a post.
     *
     * @param int $postId
     *
     * @return Post
     */
    public function post($postId)
    {
        return $this->post->findOrFail($postId);
    }

    /**
     * Adds a comment.
     *
     * @param array $comment
     *
     * @return Comment
     */
    public function addComment($comment)
    {
        return $this->comment->add($comment);
    }

    /**
     * Returns a comment.
     *
     * @param int $commentId
     *
     * @return Comment
     */
    public function comment($commentId)
    {
        return $this->comment->findOrFail($commentId);
    }
}
