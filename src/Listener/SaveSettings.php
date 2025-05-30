<?php

namespace Phpcmf\HelloWorld\Listener;

use Flarum\Settings\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;

class SaveSettings
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'onSettingsSaved']);
    }

    public function onSettingsSaved(Saving $event)
    {
        $actor = $event->actor;
        $actor->assertAdmin();

        $settings = $event->settings;
        $data = $event->data;

        $attributes = Arr::get($data, 'attributes', []);

        foreach ($attributes as $key => $value) {
            if (str_starts_with($key, 'phpcmf-helloworld.')) {
                $settings->set($key, $value);
            }
        }
    }
}
