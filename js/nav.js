(function () {
	const navBtn = document.getElementById('nav-switch');
	const menu = document.getElementById('site-navigation');

	if (!navBtn || !menu) return;

	function syncState() {
		const mobile = window.matchMedia('(max-width: 660px)').matches;
		if (mobile) {
			menu.hidden = navBtn.getAttribute('aria-expanded') !== 'true';
		} else {
			menu.hidden = false;
			navBtn.setAttribute('aria-expanded', 'false');
		}
	}

	syncState();
	window.addEventListener('resize', syncState);

	navBtn.addEventListener('click', () => {
		const open = navBtn.getAttribute('aria-expanded') === 'true';
		navBtn.setAttribute('aria-expanded', String(!open));
		menu.hidden = open;
	});

	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && navBtn.getAttribute('aria-expanded') === 'true') {
			navBtn.setAttribute('aria-expanded', 'false');
			menu.hidden = true;
			navBtn.focus();
		}
	});

	document.addEventListener('click', (e) => {
		if (
			window.matchMedia('(max-width: 660px)').matches &&
			!menu.contains(e.target) &&
			!navBtn.contains(e.target) &&
			navBtn.getAttribute('aria-expanded') === 'true'
		) {
			navBtn.setAttribute('aria-expanded', 'false');
			menu.hidden = true;
		}
	});
}());
