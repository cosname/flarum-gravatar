/*
* Copyright (c) Salva Machí <salvamb@sispixels.com>
* Copyright (c) 2017 Yixuan Qiu
*/

import User from 'flarum/models/User';
import md5 from 'cosname/gravatar/helpers/md5';

app.initializers.add('cosname/gravatar', function() {

    // Modify the function that returns the avatar URL
    User.prototype.avatarUrl = function() {
        var user = this;
        var avatar_url = user.attribute('avatarUrl');

        // If avatarURL has not been set
        if (!avatar_url) {
            // User email
            var email = user.attribute('email');
            if (email) {
                // Calculate email hash and obtain the Gravatar link
                // http://en.gravatar.com/site/implement/images/
                var hash = md5(email);
                user.pushAttributes({
                    avatarUrl: 'https://www.gravatar.com/avatar/' + hash + '?d=identicon',
                    avatarColor: null
                });
            }
        }

        return user.attribute('avatarUrl');
    };

    // Since the avatarUrl is now linking to Gravatar,
    // we need to avoid cross origin errors
    User.prototype.calculateAvatarColor = function() {
        const image = new Image();
        const user = this;

        image.onload = function() {
            const colorThief = new ColorThief();
            user.avatarColor = colorThief.getColor(this);
            user.freshness = new Date();
            m.redraw();
        };
        // https://github.com/lokesh/color-thief/issues/20
        image.crossOrigin = 'Anonymous';
        image.src = this.avatarUrl();
    };

});
