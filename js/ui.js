(function () {
	const topBtn = document.getElementById('scroll-top');
	if (topBtn) {
		topBtn.removeAttribute('hidden');

		window.addEventListener(
			'scroll',
			() => {
				topBtn.classList.toggle('is-shown', window.scrollY > 400);
			},
			{ passive: true }
		);

		topBtn.addEventListener('click', () => {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

	document.querySelectorAll('.share-bar__clipboard').forEach((el) => {
		el.addEventListener('click', () => {
			const link = el.dataset.url;
			if (!link || !navigator.clipboard) return;

			navigator.clipboard.writeText(link).then(() => {
				const prev = el.getAttribute('aria-label');
				el.setAttribute('aria-label', xerxUI.copied);
				setTimeout(() => {
					el.setAttribute('aria-label', prev);
				}, 2000);
			});
		});
	});
}());
