<?php
/*
* Copyright (c) 2017-2018 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;

// In the discussion list, by default the JS frontend only contains the 'username'
// and 'avatarUrl' attributes of users. Therefore, we cannot calculate email
// hash to obtain the Gravatar link. This class adds the 'email' attribute
// to the user so that we can get access to the email address in the frontend.
class AddUserEmailAttributes
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Serializing::class, [$this, 'addEmailAttributes']);
    }

    /**
     * Add the 'email' attribute to the user.
     *
     * @param Serializing $event
     */
    public function addEmailAttributes(Serializing $event)
    {
        if ($event->isSerializer(BasicUserSerializer::class)) {
            $event->attributes['email'] = $event->model->email;
        }
    }
}
