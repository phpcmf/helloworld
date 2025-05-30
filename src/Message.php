<?php

namespace Phpcmf\HelloWorld;

use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Carbon\Carbon;

class Message extends AbstractModel
{
    use ScopeVisibilityTrait;

    protected $table = 'helloworld_messages';

    protected $fillable = [
        'title',
        'content'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function build($title, $content)
    {
        $message = new static;

        $message->title = $title;
        $message->content = $content;
        $message->created_at = Carbon::now();

        return $message;
    }
}
