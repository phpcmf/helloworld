<?php

namespace Phpcmf\HelloWorld\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use Phpcmf\HelloWorld\Message;

class MessageSerializer extends AbstractSerializer
{
    protected $type = 'helloworld-messages';

    protected function getDefaultAttributes($message)
    {
        return [
            'title' => $message->title,
            'content' => $message->content,
            'createdAt' => $message->created_at->toISOString(),
            'updatedAt' => $message->updated_at->toISOString()
        ];
    }
}
