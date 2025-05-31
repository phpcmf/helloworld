<?php

namespace Phpcmf\HelloWorld\Models;

use Flarum\Database\AbstractModel;
use Flarum\User\User;

class HelloWorld extends AbstractModel
{
    protected $table = 'hello_world';

    protected $fillable = [
        'message',
        'user_id'
    ];

    public static function build($message, $userId)
    {
        $helloWorld = new static;

        $helloWorld->message = $message;
        $helloWorld->user_id = $userId;

        return $helloWorld;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}    