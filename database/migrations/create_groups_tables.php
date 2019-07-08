<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTables extends Migration
{
    protected $useBigIncrements;

    public function __construct()
    {
        $this->useBigIncrements = app()::VERSION >= 5.8;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($this->useBigIncrements) {
            Schema::create('groups', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('short_description')->nullable();
                $table->string('image')->nullable();
                $table->string('url')->nullable();
                $table->integer('user_id')->unsignedBigIntegers();
                $table->boolean('private')->unsigned()->default(false);
                $table->integer('conversation_id')->unsignedBigIntegers()->nullable();
                $table->text('extra_info')->nullable();
                $table->text('settings')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

            Schema::create('group_user', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->unsignedBigIntegers();
                $table->integer('group_id')->unsignedBigIntegers();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');
            });

            Schema::create('posts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->text('body');
                $table->string('type');
                $table->integer('user_id')->unsignedBigIntegers();
                $table->text('extra_info')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

            Schema::create('comments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('body');
                $table->integer('user_id')->unsignedBigIntegers();
                $table->integer('post_id')->unsignedBigIntegers();
                $table->string('type')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts');
            });

            Schema::create('group_post', function (Blueprint $table) {
                $table->integer('group_id')->unsignedBigIntegers();
                $table->integer('post_id')->unsignedBigIntegers();
                $table->timestamps();

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');
            });

            Schema::create('likes', function (Blueprint $table) {
                $table->integer('user_id')->index();
                $table->integer('likeable_id')->unsignedBigIntegers();
                $table->string('likeable_type');
                $table->primary(['user_id', 'likeable_id', 'likeable_type']);
                $table->timestamps();
            });

            Schema::create('reports', function (Blueprint $table) {
                $table->integer('user_id')->index();
                $table->integer('reportable_id')->unsignedBigIntegers();
                $table->string('reportable_type');
                $table->primary(['user_id', 'reportable_id', 'reportable_type']);
                $table->timestamps();
            });

            Schema::create('group_request', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->unsignedBigIntegers()->index();
                $table->integer('group_id')->unsignedBigIntegers()->index();
                $table->timestamps();

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        } else {
            Schema::create('groups', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('short_description')->nullable();
                $table->string('image')->nullable();
                $table->string('url')->nullable();
                $table->integer('user_id')->unsigned();
                $table->boolean('private')->unsigned()->default(false);
                $table->integer('conversation_id')->unsigned()->nullable();
                $table->text('extra_info')->nullable();
                $table->text('settings')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

            Schema::create('group_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->integer('group_id')->unsigned();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');
            });

            Schema::create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->text('body');
                $table->string('type');
                $table->integer('user_id')->unsigned();
                $table->text('extra_info')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

            Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('body');
                $table->integer('user_id')->unsigned();
                $table->integer('post_id')->unsigned();
                $table->string('type')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts');
            });

            Schema::create('group_post', function (Blueprint $table) {
                $table->integer('group_id')->unsigned();
                $table->integer('post_id')->unsigned();
                $table->timestamps();

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');
            });

            Schema::create('likes', function (Blueprint $table) {
                $table->integer('user_id')->index();
                $table->integer('likeable_id')->unsigned();
                $table->string('likeable_type');
                $table->primary(['user_id', 'likeable_id', 'likeable_type']);
                $table->timestamps();
            });

            Schema::create('reports', function (Blueprint $table) {
                $table->integer('user_id')->index();
                $table->integer('reportable_id')->unsigned();
                $table->string('reportable_type');
                $table->primary(['user_id', 'reportable_id', 'reportable_type']);
                $table->timestamps();
            });

            Schema::create('group_request', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->index();
                $table->integer('group_id')->unsigned()->index();
                $table->timestamps();

                $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
        Schema::drop('group_user');
        Schema::drop('posts');
        Schema::drop('comments');
        Schema::drop('group_post');
        Schema::drop('likes');
        Schema::drop('reports');
        Schema::drop('group_request');
    }
}
