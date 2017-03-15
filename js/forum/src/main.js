/*
* Copyright (c) Salva Machí <salvamb@sispixels.com>
* Copyright (c) 2017 Yixuan Qiu
*/

import User from 'flarum/models/User';
import md5 from 'cosname/gravatar/helpers/md5';

app.initializers.add('cosname/gravatar', function() {

	User.prototype.avatarUrl = function() {
        var user = this;
        var avatar_url = user.attribute('avatarUrl');

		if (!avatar_url) {
            var email = user.attribute('email');
            if (email) {
                var hash = md5(email);
                user.pushAttributes({
                    avatarUrl: 'https://www.gravatar.com/avatar/' + hash + '?d=identicon',
                    avatarColor: null
                });
            }
		}

		return user.attribute('avatarUrl');
	};

    /*
	User.prototype.calculateAvatarColor = function() {
		const image = new Image();
		const user = this;

		image.onload = function() {
			const colorThief = new ColorThief();
			user.avatarColor = colorThief.getColor(this);
			user.freshness = new Date();
			m.redraw();
		};
        image.crossOrigin = 'Anonymous';
		image.src = this.avatarUrl();
	};
    */

});
