<?php

require __DIR__.'/../database/migrations/create_groups_tables.php';

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Musonza\Groups\Facades\GroupsFacade;
use Musonza\Groups\GroupsServiceProvider;
use Musonza\Groups\Models\Comment;
use Musonza\Groups\Models\Group;
use Musonza\Groups\Models\Post;
use Orchestra\Database\ConsoleServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class GroupsTestCase extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var Comment
     */
    public $comment;
    public $user;
    /**
     * @var Group
     */
    public $group;
    /**
     * @var Post
     */
    public $post;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'testbench']);
        $this->withFactories(__DIR__.'/../database/factories');
        $this->migrate();
    }

    protected function migrateTestTables()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected function migrate()
    {
        $this->migrateTestTables();
        (new CreateGroupsTables())->up();
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            ConsoleServiceProvider::class,
            GroupsServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Groups' => GroupsFacade::class,
        ];
    }

    public function tearDown() : void
    {
        (new CreateGroupsTables())->down();
        $this->rollbackTestTables();
        parent::tearDown();
    }

    protected function rollbackTestTables()
    {
        Schema::drop('users');
    }

    public function createUsers($count = 1)
    {
        $users = factory('Musonza\Groups\User', $count)->create();

        if ($count == 1) {
            return $users[0];
        }

        return $users;
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
