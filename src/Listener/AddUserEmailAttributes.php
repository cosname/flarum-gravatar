<?php
/*
* Copyright (c) 2017 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Api\Serializer\UserBasicSerializer;
use Flarum\Event\PrepareApiAttributes;
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
        $events->listen(PrepareApiAttributes::class, [$this, 'addEmailAttributes']);
    }

    /**
     * Add the 'email' attribute to the user.
     *
     * @param PrepareApiAttributes $event
     */
    public function addEmailAttributes(PrepareApiAttributes $event)
    {
        if ($event->isSerializer(UserBasicSerializer::class)) {
            $event->attributes['email'] = $event->model->email;
        }
    }
}
