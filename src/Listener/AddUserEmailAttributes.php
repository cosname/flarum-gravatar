<?php
/*
* Copyright (c) 2017 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Api\Serializer\UserBasicSerializer;
use Flarum\Event\PrepareApiAttributes;
use Illuminate\Contracts\Events\Dispatcher;

class AddUserEmailAttributes
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
	public function subscribe(Dispatcher $events)
    {
		$events->listen(prepareApiAttributes::class, [$this, 'addEmailAttributes']);
	}

    /**
     * Add forum assets.
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
