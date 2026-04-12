(function () {
	/* ---- Sticky header scroll state ---- */
	var header = document.querySelector('.site-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 10);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---- Mobile drawer ---- */
	var menuBtn = document.getElementById('menu-toggle');
	var drawer = document.getElementById('mobile-drawer');
	var backdrop = document.getElementById('mobile-backdrop');
	var closeBtn = document.getElementById('mobile-close');

	function openDrawer() {
		if (!drawer) return;
		drawer.classList.add('is-open');
		backdrop.classList.add('is-active');
		menuBtn.setAttribute('aria-expanded', 'true');
		document.body.style.overflow = 'hidden';
	}

	function closeDrawer() {
		if (!drawer) return;
		drawer.classList.remove('is-open');
		backdrop.classList.remove('is-active');
		menuBtn.setAttribute('aria-expanded', 'false');
		document.body.style.overflow = '';
	}

	if (menuBtn) {
		menuBtn.addEventListener('click', function () {
			var isOpen = menuBtn.getAttribute('aria-expanded') === 'true';
			if (isOpen) {
				closeDrawer();
			} else {
				openDrawer();
			}
		});
	}

	if (closeBtn) {
		closeBtn.addEventListener('click', closeDrawer);
	}

	if (backdrop) {
		backdrop.addEventListener('click', closeDrawer);
	}

	/* ---- Search overlay ---- */
	var searchToggle = document.getElementById('search-toggle');
	var searchOverlay = document.getElementById('search-overlay');
	var searchInput = searchOverlay ? searchOverlay.querySelector('.search-overlay__input') : null;

	function openSearch() {
		if (!searchOverlay) return;
		searchOverlay.classList.add('is-active');
		document.body.style.overflow = 'hidden';
		if (searchInput) {
			setTimeout(function () { searchInput.focus(); }, 100);
		}
	}

	function closeSearch() {
		if (!searchOverlay) return;
		searchOverlay.classList.remove('is-active');
		document.body.style.overflow = '';
	}

	if (searchToggle) {
		searchToggle.addEventListener('click', openSearch);
	}

	if (searchOverlay) {
		searchOverlay.addEventListener('click', function (e) {
			if (e.target === searchOverlay) {
				closeSearch();
			}
		});
	}

	/* Keyboard shortcuts */
	document.addEventListener('keydown', function (e) {
		/* Escape closes everything */
		if (e.key === 'Escape') {
			if (searchOverlay && searchOverlay.classList.contains('is-active')) {
				closeSearch();
				return;
			}
			if (drawer && drawer.classList.contains('is-open')) {
				closeDrawer();
				menuBtn.focus();
				return;
			}
		}

		/* Ctrl/Cmd + K opens search */
		if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
			e.preventDefault();
			if (searchOverlay && searchOverlay.classList.contains('is-active')) {
				closeSearch();
			} else {
				openSearch();
			}
		}
	});

	/* Close drawer on resize to desktop */
	window.addEventListener('resize', function () {
		if (window.innerWidth > 768 && drawer && drawer.classList.contains('is-open')) {
			closeDrawer();
		}
	});
}());
