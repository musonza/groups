<?php

namespace Musonza\Groups;

use Musonza\Groups\Models\Comment;
use Musonza\Groups\Models\Group;
use Musonza\Groups\Models\Post;
use Musonza\Groups\Models\User;

class Groups
{
    public function __construct(Comment $comment, Group $group, Post $post, User $user)
    {
        $this->comment = $comment;
        $this->group = $group;
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Returns User instance with group relation
     *
     * @param      integer  $userId
     *
     * @return     User
     */
    public function getUser($userId)
    {
        return $this->user->find($userId);
    }

    /**
     * Creates a group
     *
     * @param      integer  $user_id  owner of group
     * @param      array  $data     group information
     *
     * @return     Group
     */
    public function create($user_id, $data)
    {
        return $this->group->make($user_id, $data);
    }

    /**
     * Returns a group
     *
     * @param      integer  $groupId
     *
     * @return     Group
     */
    public function group($groupId)
    {
        return $this->group->findOrFail($groupId);
    }

    /**
     * Creates a post
     *
     * @param      array  $data
     *
     * @return     Post
     */
    public function createPost($data)
    {
        return $this->post->make($data);
    }

    /**
     * Returns a post
     *
     * @param      integer  $postId
     *
     * @return     Post
     */
    public function post($postId)
    {
        return $this->post->findOrFail($postId);
    }

    /**
     * Adds a comment
     *
     * @param      array  $comment
     *
     * @return     Comment
     */
    public function addComment($comment)
    {
        return $this->comment->add($comment);
    }

    /**
     * Returns a comment
     *
     * @param      integer  $commentId
     *
     * @return     Comment
     */
    public function comment($commentId)
    {
        return $this->comment->findOrFail($commentId);
    }
}
