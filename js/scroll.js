const observer = new IntersectionObserver((entries) => {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			entry.target.classList.remove('entry--hidden');
			observer.unobserve(entry.target);
		}
	});
}, {
	rootMargin: '0px 0px 50px 0px',
	threshold: 0
});

document.querySelectorAll('.entry').forEach((el) => {
	const rect = el.getBoundingClientRect();
	if (rect.top > window.innerHeight) {
		el.classList.add('entry--hidden');
		observer.observe(el);
	}
});
