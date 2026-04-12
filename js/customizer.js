(function ($) {
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			var brandEl = '.site-header__brand, .banner__title a';
			if ('blank' === to) {
				$(brandEl).css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$(brandEl).css({
					'clip': 'auto',
					'position': 'relative',
					'color': to
				});
			}
		});
	});

	wp.customize('header_bgcolor', function (value) {
		value.bind(function (to) {
			document.documentElement.style.setProperty('--surface', to);
		});
	});

	wp.customize('header_image', function (value) {
		value.bind(function (to) {
			$('.banner').css('background-image', 'url(' + to + ')');
		});
	});

	wp.customize('fgcolor', function (value) {
		value.bind(function (to) {
			document.documentElement.style.setProperty('--ink', to);
		});
	});
})(jQuery);
