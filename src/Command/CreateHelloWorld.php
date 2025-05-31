<?php

namespace Phpcmf\HelloWorld\Command;

use Flarum\User\User;

class CreateHelloWorld
{
    public $actor;
    public $data;

    public function __construct(User $actor, array $data)
    {
        $this->actor = $actor;
        $this->data = $data;
    }
}    