<?php
/*
* Copyright (c) Salva Machí <salvamb@sispixels.com>
* Copyright (c) 2017 Yixuan Qiu
*/

use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
	$events->subscribe(Listener\AddGravatarAssets::class);
    $events->subscribe(Listener\AddUserEmailAttributes::class);
};
