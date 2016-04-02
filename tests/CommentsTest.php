<?php

class CommentsTest extends GroupsTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->addedComment = $this->createGroupPostAndComment();
    }

    /** @test **/
    public function it_can_add_a_comment_to_a_post()
    {
        $this->seeInDatabase('comments', $this->comment);
    }

    /** @test */
    public function it_can_return_a_comment()
    {
        $comment = Groups::comment($this->addedComment->id);

        $this->assertEquals(1, $comment->id);
    }

    /** @test **/
    public function it_can_delete_a_comment()
    {
        $this->addedComment->delete();

        $this->dontSeeInDatabase('comments', $this->comment);
    }

    /** @test **/
    public function it_can_update_a_comment()
    {
        $newComment = $this->comment;

        $newComment['body'] = 'updated comment';

        $this->addedComment->update($newComment);

        $this->seeInDatabase('comments', $newComment);
    }

    /** @test **/
    public function a_user_can_report_a_comment()
    {
        $this->addedComment->report($this->user->id);

        $this->seeInDatabase('reports', [
            'user_id' => $this->user->id,
            'reportable_id' => $this->addedComment->id,
            'reportable_type' => get_class($this->addedComment),
        ]);

        $this->assertTrue($this->addedComment->isReported($this->user->id));
    }

    /** @test **/
    public function a_comment_knows_how_many_reports_it_has()
    {
        $this->addedComment->toggleReport($this->user->id);

        $this->assertEquals(1, $this->addedComment->reportsCount);

        $this->addedComment->toggleReport($this->user->id);

        $this->assertEquals(0, $this->addedComment->reportsCount);
    }
}
