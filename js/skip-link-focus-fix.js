(function () {
	const isLegacy = /(trident|msie)/i.test(navigator.userAgent);

	if (isLegacy && document.getElementById && window.addEventListener) {
		window.addEventListener('hashchange', function () {
			const hash = location.hash.substring(1);

			if (!(/^[A-z0-9_-]+$/.test(hash))) {
				return;
			}

			const target = document.getElementById(hash);

			if (target) {
				if (!(/^(?:a|select|input|button|textarea)$/i.test(target.tagName))) {
					target.tabIndex = -1;
				}

				target.focus();
			}
		}, false);
	}
}());
