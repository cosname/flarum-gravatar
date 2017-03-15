/*
* Copyright (c) Salva Machí <salvamb@sispixels.com>
* Copyright (c) 2017 Yixuan Qiu
*/

import { extend } from 'flarum/extend';
import User from 'flarum/models/User';
import DiscussionList from 'flarum/components/DiscussionList';
import md5 from 'cosname/gravatar/helpers/md5';

app.initializers.add('cosname/gravatar', function() {

    extend(DiscussionList.prototype, 'init', function() {
        console.log(this);
        var userids = this.discussions.map(discussion => discussion.startUser().id());
        console.log(userids);
        app.store.find('users', userids);
        console.log(1);
    });

	User.prototype.avatarUrl = function() {
        var user = this;
        var avatar_url = user.attribute('avatarUrl');

		if (!avatar_url) {
            var email = user.attribute('email');
            if (!email) {
                // app.store.find("users", user.id());
                // email = user.attribute('email');
            }
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
