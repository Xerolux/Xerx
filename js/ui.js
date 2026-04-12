(function () {
	/* ---- Back to top button ---- */
	var topBtn = document.getElementById('back-to-top');
	if (topBtn) {
		topBtn.removeAttribute('hidden');

		window.addEventListener(
			'scroll',
			function () {
				topBtn.classList.toggle('is-shown', window.scrollY > 400);
			},
			{ passive: true }
		);

		topBtn.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

	/* ---- Share link copy-to-clipboard ---- */
	document.querySelectorAll('.share-bar__clipboard').forEach(function (el) {
		el.addEventListener('click', function () {
			var link = el.dataset.url;
			if (!link || !navigator.clipboard) return;

			navigator.clipboard.writeText(link).then(function () {
				var prev = el.getAttribute('aria-label');
				el.setAttribute('aria-label', xerxUi.copied);
				setTimeout(function () {
					el.setAttribute('aria-label', prev);
				}, 2000);
			});
		});
	});

	/* ---- Code block copy buttons ---- */
	document.querySelectorAll('.entry__body pre').forEach(function (pre) {
		/* Skip if already wrapped */
		if (pre.parentNode.classList && pre.parentNode.classList.contains('code-block-wrapper')) return;

		var wrapper = document.createElement('div');
		wrapper.className = 'code-block-wrapper';
		pre.parentNode.insertBefore(wrapper, pre);
		wrapper.appendChild(pre);

		var btn = document.createElement('button');
		btn.className = 'code-copy-btn';
		btn.type = 'button';
		btn.setAttribute('aria-label', 'Copy code');
		btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg><span>Copy</span>';

		wrapper.appendChild(btn);

		btn.addEventListener('click', function () {
			var code = pre.textContent || pre.innerText;
			if (!navigator.clipboard) return;

			navigator.clipboard.writeText(code).then(function () {
				btn.classList.add('is-copied');
				btn.querySelector('span').textContent = 'Copied!';
				setTimeout(function () {
					btn.classList.remove('is-copied');
					btn.querySelector('span').textContent = 'Copy';
				}, 2000);
			});
		});
	});

	/* ---- Table of Contents (auto-generated on single posts) ---- */
	var tocContainer = document.getElementById('xerx-toc');
	var entryBody = document.querySelector('.entry__body.e-content');

	if (tocContainer && entryBody) {
		var headings = entryBody.querySelectorAll('h2, h3');
		if (headings.length >= 3) {
			var list = document.createElement('ol');
			list.className = 'toc__list';
			var currentH2Item = null;
			var subList = null;

			headings.forEach(function (heading, i) {
				/* Generate ID if missing */
				if (!heading.id) {
					heading.id = 'section-' + (i + 1);
				}

				var li = document.createElement('li');
				var a = document.createElement('a');
				a.href = '#' + heading.id;
				a.textContent = heading.textContent;

				if (heading.tagName === 'H2') {
					li.appendChild(a);
					list.appendChild(li);
					currentH2Item = li;
					subList = null;
				} else if (heading.tagName === 'H3') {
					if (!subList) {
						subList = document.createElement('ol');
						subList.className = 'toc__sub';
						if (currentH2Item) {
							currentH2Item.appendChild(subList);
						} else {
							list.appendChild(subList);
						}
					}
					li.appendChild(a);
					subList.appendChild(li);
				}
			});

			var title = document.createElement('h3');
			title.className = 'toc__title';
			title.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg> Table of Contents';

			tocContainer.appendChild(title);
			tocContainer.appendChild(list);
			tocContainer.style.display = '';
		}
	}
}());
