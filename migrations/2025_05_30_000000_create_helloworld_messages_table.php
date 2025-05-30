<?php

use Flarum\Database\Migration;

return Migration::createTable(
    'helloworld_messages',
    function ($table) {
        $table->increments('id');
        $table->string('title');
        $table->text('content');
        $table->timestamp('created_at');
        $table->timestamp('updated_at')->nullable();
    }
);
