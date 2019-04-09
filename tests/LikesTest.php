<?php

class LikesTest extends GroupsTestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->user = $this->createUsers();

        $this->comment = $this->createGroupPostAndComment();
    }

    /** @test **/
    public function a_user_can_like_a_post()
    {
        $this->post->like($this->user->id);

        $this->assertDatabaseHas('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);

        $this->assertTrue($this->post->isLiked($this->user->id));
    }

    /** @test **/
    public function a_user_can_unlike_a_post()
    {
        $this->post->like($this->user->id);

        $this->post->unlike($this->user->id);

        $this->assertDatabaseMissing('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);

        $this->assertFalse($this->post->isLiked($this->user->id));
    }

    /** @test **/
    public function a_user_can_toggle_like_a_post()
    {
        $this->post->toggleLike($this->user->id);

        $this->assertTrue($this->post->isLiked($this->user->id));

        $this->post->toggleLike($this->user->id);

        $this->assertFalse($this->post->isLiked($this->user->id));
    }

    /** @test **/
    public function a_post_knows_how_many_likes_it_has()
    {
        $this->post->toggleLike($this->user->id);

        $this->assertEquals(1, $this->post->likesCount);
    }

    /** @test **/
    public function a_user_can_like_a_comment()
    {
        $this->comment->like($this->user->id);

        $this->assertDatabaseHas('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->comment->id,
            'likeable_type' => get_class($this->comment),
        ]);

        $this->assertTrue($this->comment->isLiked($this->user->id));
    }

    /** @test **/
    public function a_comment_knows_how_many_likes_it_has()
    {
        $this->comment->toggleLike($this->user->id);

        $this->assertEquals(1, $this->comment->likesCount);

        $this->comment->toggleLike($this->user->id);

        $this->assertEquals(0, $this->comment->likesCount);
    }
}
