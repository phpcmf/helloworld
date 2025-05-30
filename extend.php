<?php

use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;
use Phpcmf\HelloWorld\Listener;
use Illuminate\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('api'))
        ->post('/helloworld', 'helloworld.store', 'Phpcmf\HelloWorld\Api\Controllers\StoreMessageController'),

    (new Extend\Settings())
        ->serializeToForum('helloworld.title', 'phpcmf-helloworld.title')
        ->serializeToForum('helloworld.content', 'phpcmf-helloworld.content'),

    function (Dispatcher $events) {
        $events->subscribe(Listener\AddClientAssets::class);
        $events->subscribe(Listener\SaveSettings::class);
    }
];
