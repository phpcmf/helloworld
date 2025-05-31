<?php

namespace Phpcmf\HelloWorld\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Phpcmf\HelloWorld\Api\Serializers\HelloWorldSerializer;
use Phpcmf\HelloWorld\Query\HelloWorldQuery;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListHelloWorldController extends AbstractListController
{
    public $serializer = HelloWorldSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $queryParams = $request->getQueryParams();

        return HelloWorldQuery::forList($actor, $queryParams);
    }
}    