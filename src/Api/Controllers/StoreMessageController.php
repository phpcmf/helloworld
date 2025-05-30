<?php

namespace Phpcmf\HelloWorld\Api\Controllers;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;
use Phpcmf\HelloWorld\Message;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class StoreMessageController extends AbstractCreateController
{
    public $serializer = 'Phpcmf\HelloWorld\Api\Serializers\MessageSerializer';

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertAdmin();

        $data = $request->getParsedBody()['data']['attributes'];

        $message = Message::build(
            $data['title'],
            $data['content']
        );

        $message->save();

        return $message;
    }
}
