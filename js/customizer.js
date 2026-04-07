(function ($) {
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			const textSels = '.banner__title, .banner__tagline, .navbar__title, .navbar__tagline';
			const colorSels = '.banner__title a, .banner__tagline, .navbar__title a, .navbar__tagline';

			if ('blank' === to) {
				$(textSels).css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$(textSels).css({
					'clip': 'auto',
					'position': 'relative'
				});
				$(colorSels).css({
					'color': to
				});
			}
		});
	});

	wp.customize('header_bgcolor', function (value) {
		value.bind(function (to) {
			$('.banner').css('background-color', to);
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
