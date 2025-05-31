<?php

use Flarum\Extend;
use Phpcmf\HelloWorld\Listener;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Event\GetApiRelationship;
use Flarum\Event\ApiAttributes;
use Flarum\Event\ConfigureForumRoutes;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('api'))
        ->post('/helloworld', 'helloworld.create', 'Phpcmf\HelloWorld\Api\Controllers\CreateHelloWorldController')
        ->get('/helloworld', 'helloworld.list', 'Phpcmf\HelloWorld\Api\Controllers\ListHelloWorldController'),

    // 使用正确的 Extend\Event 注册方式
    (new Extend\Event())
        ->listen(GetApiRelationship::class, [Listener\AddClientAssets::class, 'getApiRelationship'])
        ->listen(ApiAttributes::class, [Listener\AddClientAssets::class, 'addApiAttributes']),

    // 添加路由扩展
    (new Extend\Routes('forum'))
        ->get('/helloworld', 'helloworld.index', 'Phpcmf\HelloWorld\Forum\Content\HelloWorld'),
];    