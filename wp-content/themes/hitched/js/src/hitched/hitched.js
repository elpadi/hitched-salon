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
	var init = function() {
		initMenu();
	};
	return {
		init: init
	};
})();
