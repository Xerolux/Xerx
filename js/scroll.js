/* Lazy reveal animation using Intersection Observer */
(function () {
	if (!('IntersectionObserver' in window)) return;

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				entry.target.classList.remove('entry--hidden');
				observer.unobserve(entry.target);
			}
		});
	}, {
		rootMargin: '0px 0px -30px 0px',
		threshold: 0.05
	});

	document.querySelectorAll('.entry').forEach(function (el) {
		var rect = el.getBoundingClientRect();
		if (rect.top > window.innerHeight) {
			el.classList.add('entry--hidden');
			observer.observe(el);
		}
	});
}());
