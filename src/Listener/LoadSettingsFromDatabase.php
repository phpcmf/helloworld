<?php

namespace Phpcmf\HelloWorld\Listener;

use Flarum\Settings\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;

class LoadSettingsFromDatabase
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'onSettingsSaved']);
    }

    public function onSettingsSaved(Saving $event)
    {
        // 处理设置保存事件
    }
}    