document.addEventListener('DOMContentLoaded', () => {
	if (!xerxTheme.enabled) return;

	const toggle = document.getElementById('theme-switch');
	if (!toggle) return;

	let storedPref = null;
	try {
		storedPref = localStorage.getItem('xerx-pref');
	} catch (e) {
		storedPref = null;
	}

	const canMatchMedia = typeof window.matchMedia === 'function';
	const systemDark = canMatchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
	const shouldEnable = storedPref === 'dark' || (!storedPref && systemDark);

	if (shouldEnable) {
		document.documentElement.classList.add('dark-mode');
	}

	toggle.setAttribute('aria-pressed', String(shouldEnable));

	toggle.addEventListener('click', () => {
		document.documentElement.classList.toggle('dark-mode');
		const active = document.documentElement.classList.contains('dark-mode');

		toggle.setAttribute('aria-pressed', String(active));

		try {
			localStorage.setItem('xerx-pref', active ? 'dark' : 'light');
		} catch (e) {}
	});

	if (canMatchMedia) {
		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
			if (localStorage.getItem('xerx-pref')) return;
			document.documentElement.classList.toggle('dark-mode', e.matches);
			toggle.setAttribute('aria-pressed', String(e.matches));
		});
	}
});
