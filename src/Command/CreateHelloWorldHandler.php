<?php

namespace Phpcmf\HelloWorld\Command;

use Flarum\User\AssertPermissionTrait;
use Flarum\User\User;
use Phpcmf\HelloWorld\Models\HelloWorld;

class CreateHelloWorldHandler
{
    use AssertPermissionTrait;

    public function handle(CreateHelloWorld $command)
    {
        $actor = $command->actor;
        $data = $command->data;

        $this->assertCan($actor, 'createHelloWorld');

        $helloWorld = HelloWorld::build(
            $data['attributes']['message'] ?? '',
            $actor->id
        );

        $helloWorld->save();

        return $helloWorld;
    }
}    