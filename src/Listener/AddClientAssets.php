<?php

namespace Phpcmf\HelloWorld\Listener;

use Flarum\Event\ConfigureClientView;
use Illuminate\Contracts\Events\Dispatcher;

class AddClientAssets
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureClientView::class, [$this, 'addAssets']);
    }

    public function addAssets(ConfigureClientView $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__.'/../../js/dist/forum.js',
                __DIR__.'/../../less/forum.less'
            ]);
            $event->addBootstrapper('phpcmf/helloworld/main');
        }

        if ($event->isAdmin()) {
            $event->addAssets([
                __DIR__.'/../../js/dist/admin.js',
                __DIR__.'/../../less/admin.less'
            ]);
            $event->addBootstrapper('phpcmf/helloworld/admin');
        }
    }
}
