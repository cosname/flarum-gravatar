<?php
/*
* Copyright (c) Salva Machí <salvamb@sispixels.com>
* Copyright (c) 2017 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;

class AddGravatarAssets
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addForumAssets']);
    }

    /**
     * Add forum assets.
     *
     * @param ConfigureWebApp $event
     */
    public function addForumAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__ . '/../../js/forum/dist/extension.js'
            ]);
            $event->addBootstrapper('cosname/gravatar/main');
        }
    }
}
