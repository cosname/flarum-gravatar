<?php

use Flarum\Extend;
use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return [
    // Load JS script
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    
    // Add listener
    function (Dispatcher $events) {
        $events->subscribe(Listener\AddUserEmailAttributes::class);
    }
];
