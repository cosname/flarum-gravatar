<?php

use Flarum\Extend;
use Flarum\Api\Serializer\BasicUserSerializer;

return [
    // Load JS script
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    
    // Add user email
    //
    // In the discussion list, by default the JS frontend only contains the 'username'
    // and 'avatarUrl' attributes of users. Therefore, we cannot calculate email
    // hash to obtain the Gravatar link. This extendor adds the 'email' attribute
    // to the user so that we can get access to the email address in the frontend.
    //
    // See https://github.com/flarum/core/blob/master/tests/integration/extenders/ApiSerializerTest.php
    // and https://github.com/flarum/core/blob/master/src/Extend/ApiSerializer.php
    (new Extend\ApiSerializer(BasicUserSerializer::class))
        ->attribute('email', function($serializer, $model, $attributes) {
            return $model->email;
        })
];
