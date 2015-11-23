var Hitched = (function() {
	
	var initMenu = function() {
		document.getElementById('main-menu').addDelegatedEventListener('click', function(el) {
			return el.nodeName === 'LI' && el.classList.contains('menu-item-has-children');
		}, function(e) {
			if (e.target.nodeName !== 'A' || e.target.href === '') {
				e.preventDefault();
			}
			this.classList.toggle('children-visible');
		});
	};

	var initFaq = function() {
		var hasFinished = true;
		document.getElementById('post-16').addDelegatedEventListener('click', function(el) {
			return el.nodeName === 'LI';
		}, function(e) {
			if (!hasFinished) return;
			hasFinished = false;
			var li = this.nextElementSibling
			li.classList.toggle('current');
			setTimeout(function() {
				if (li.classList.contains('current')) {
					var height = li.offsetHeight;
					li.style.height = '0';
					setTimeout(function() {
						li.style.height = height + 'px';
						li.classList.add('visible');
					}, 16);
					setTimeout(function() {
						hasFinished = true;
					}, 300);
				}
				else {
					setTimeout(function() {
						li.classList.remove('visible');
						hasFinished = true;
					}, 300);
					li.style.height = '';
				}
			}, 16);
		});
	};

	var init = function() {
		initMenu();
		if (document.body.classList.contains('page-id-16')) initFaq();
	};

	return {
		init: init
	};

})();
