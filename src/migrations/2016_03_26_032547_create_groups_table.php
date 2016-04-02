<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
