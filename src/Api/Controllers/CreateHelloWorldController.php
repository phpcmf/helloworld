<?php

namespace Phpcmf\HelloWorld\Api\Controllers;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;
use Phpcmf\HelloWorld\Api\Serializers\HelloWorldSerializer;
use Phpcmf\HelloWorld\Command\CreateHelloWorld;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateHelloWorldController extends AbstractCreateController
{
    public $serializer = HelloWorldSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $data = $request->getParsedBody()['data'] ?? [];

        return $this->bus->dispatch(
            new CreateHelloWorld($actor, $data)
        );
    }
}    