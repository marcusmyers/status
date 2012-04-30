function render_module(name, args, firstrun) {
  $('#' + name).load('modules/' + name + '.module.php?' + args , function() {
    if (firstrun==1)
        module_init (name);
    });
}

function activate_module(name, seconds, args) {
  render_module(name, args, 1);
  if (seconds > 0) {
    setInterval("render_module('"+name+"', '"+args+"', '0')", (seconds * 1000));
  }
}

$(document).ready(function() {
  $('.middle').each(function(id, val) {
    var outer_height = $(val).height();
    var inner_height = $(val).children().first().height();
    var buffer = (outer_height - inner_height) / 2;
    var SEL = '#' + $(val).attr('id') + '>div';
    $(SEL).css('marginTop', buffer);
    $(SEL).css('marginBottom', buffer);
  });
});


function module_init (name) {
    switch (name) {
        default:
	break;
    }
}

function twitterlib_init(selector, fn, subject) {
	var container = $(selector);
	
	twitterlib.timeline(subject, { limit : 10 }, function (tweets) {
		var list = $('<ul />'), i
			len = tweets.length,
			totalWidth = 0;					
		for (i = 0; i < len; i++ ) {
			$('<li><a><img/></a></li>')
				.find('a')
				.attr('href', 'http://www.twitter.com/' + tweets[i].user.screen_name + '/status/' + tweets[i].id)
				.end()
					.find('img')
					.attr('src', tweets[i].user.profile_image_url)
					.end()
			.append(this.ify.clean(tweets[i].text))
			.appendTo(list);
		}
		container.append(list);
		
		$('li', list).each(function (i, el) {
			
			totalWidth += $(el).outerWidth(true);
		});
		
		list.width(totalWidth);
		
		function scrollTweets() {
			var rand = totalWidth * Math.floor(Math.random() * 10 + 15);
			list.startAnimation({
				right: totalWidth
			}, rand, 'linear', function () {
				list.css('right', - container.width());
				scrollTweets();
			});
		}
		
		scrollTweets();
		
		list.hover(function () {
			list.pauseAnimation();
		}, function () {
			list.resumeAnimation();
		});
	}); // end of twitterlib

} 
});
