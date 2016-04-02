<?php

class PostTest extends GroupsTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = $this->createUsers();

        $this->data = ['user_id' => $this->user->id, 'title' => 'my title', 'body' => 'This is the body', 'type' => 'text'];

        $this->group = $this->createGroup($this->user->id);

        $this->post = Groups::createPost($this->data);
    }

    /** @test **/
    public function it_creates_a_post()
    {
        $this->seeInDatabase('posts', ['id' => 1, 'title' => 'my title', 'body' => 'This is the body']);
    }

    /** @test **/
    public function it_updates_a_post()
    {
        $this->data['title'] = 'new title';

        $this->post->update($this->data);

        $this->seeInDatabase('posts', ['id' => 1, 'title' => 'new title', 'body' => 'This is the body']);
    }

    /** @test **/
    public function it_can_delete_a_post()
    {
        $this->post->delete();

        $this->dontSeeInDatabase('posts', ['id' => 1, 'title' => 'my title', 'body' => 'This is the body']);
    }

    /** @test */
    public function it_can_return_a_post()
    {
        $post = Groups::post($this->post->id);

        $this->assertEquals(1, $post->id);
    }

    /** @test **/
    public function it_can_attach_a_post_to_a_group()
    {
        $this->group->attachPost($this->post->id);

        $this->seeInDatabase('group_post', ['post_id' => 1, 'group_id' => 1]);
    }

    /** @test **/
    public function it_detach_a_post_from_a_group()
    {
        $this->group->attachPost($this->post->id);

        $this->seeInDatabase('group_post', ['post_id' => 1, 'group_id' => 1]);

        $this->group->detachPost($this->post->id);

        $this->assertEquals(0, $this->group->fresh()->posts->count());
    }

    /** @test **/
    public function it_can_attach_multiple_posts_to_a_group()
    {
        $this->post2 = Groups::createPost($this->data);

        $this->group->attachPost([$this->post->id, $this->post2->id]);

        $this->assertEquals(2, $this->group->fresh()->posts->count());
    }

    /** @test **/
    public function it_can_count_user_posts()
    {
        $this->post2 = Groups::createPost($this->data);

        $user = Musonza\Groups\Models\User::find(1);

        dd($user->posts);

        $this->assertEquals(2, $user->posts->count());
    }

    /** @test **/
    public function a_user_can_report_a_post()
    {
        $this->post->report($this->user->id);

        $this->seeInDatabase('reports', [
            'user_id' => $this->user->id,
            'reportable_id' => $this->post->id,
            'reportable_type' => get_class($this->post),
        ]);

        $this->assertTrue($this->post->isReported($this->user->id));
    }

}
