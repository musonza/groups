<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class GroupsTestCase extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    public function createUsers($count = 1)
    {
        return factory('App\User', $count)->create();
    }

    public function createGroup($owner)
    {
        $data = ['name' => 'Lorem'];

        return Groups::create($owner, $data);
    }

    public function createPost($owner)
    {
        $data = ['user_id' => $owner, 'title' => 'my title', 'body' => 'This is the body', 'type' => 'text'];

        return Groups::createPost($data);
    }

    public function createGroupPostAndComment()
    {
        $this->user = $this->createUsers();

        $this->group = $this->createGroup($this->user->id);

        $this->post = $this->createPost($this->user->id);

        $this->group->attachPost($this->post->id);

        $this->comment = ['post_id' => $this->post->id, 'user_id' => $this->user->id, 'body' => 'This is my comment'];

        return Groups::addComment($this->comment);
    }

}
