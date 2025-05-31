<?php

use Flarum\Database\Migration;

return Migration::createTable(
    'hello_world',
    function ($table) {
        $table->increments('id');
        $table->text('message');
        $table->integer('user_id')->unsigned();
        $table->timestamp('created_at');
        $table->timestamp('updated_at')->nullable();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    }
);    