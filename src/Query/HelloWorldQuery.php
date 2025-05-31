<?php

namespace Phpcmf\HelloWorld\Query;

use Flarum\Database\AbstractModel;
use Flarum\User\User;
use Phpcmf\HelloWorld\Models\HelloWorld;
use Illuminate\Database\Eloquent\Builder;

class HelloWorldQuery
{
    public static function forList(User $actor, array $queryParams)
    {
        $query = HelloWorld::query();

        static::applyVisibleTo($query, $actor);
        static::applySort($query, $queryParams);
        static::applyLimit($query, $queryParams);

        return $query->get();
    }

    protected static function applyVisibleTo(Builder $query, User $actor)
    {
        $query->whereVisibleTo($actor);
    }

    protected static function applySort(Builder $query, array $queryParams)
    {
        $sort = $queryParams['sort'] ?? '-created_at';

        if (substr($sort, 0, 1) === '-') {
            $query->orderByDesc(substr($sort, 1));
        } else {
            $query->orderBy($sort);
        }
    }

    protected static function applyLimit(Builder $query, array $queryParams)
    {
        $limit = array_get($queryParams, 'limit', 20);
        $offset = array_get($queryParams, 'offset', 0);

        $query->limit($limit)->offset($offset);
    }
}    