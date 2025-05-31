<?php

namespace Phpcmf\HelloWorld\Api\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;
use InvalidArgumentException;
use Phpcmf\HelloWorld\Models\HelloWorld;

class HelloWorldSerializer extends AbstractSerializer
{
    protected $type = 'hello-world';

    protected function getDefaultAttributes($model)
    {
        if (!($model instanceof HelloWorld)) {
            throw new InvalidArgumentException(
                get_class($this).' can only serialize instances of '.HelloWorld::class
            );
        }

        return [
            'message' => $model->message,
            'createdAt' => $this->formatDate($model->created_at),
            'updatedAt' => $this->formatDate($model->updated_at)
        ];
    }
}    