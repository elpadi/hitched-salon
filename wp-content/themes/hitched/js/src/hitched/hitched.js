var Hitched = (function() {

	var vw, vh;
	var home_slideshow;
	
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

	var initHome = function() {
		home_slideshow = new HomeSlideshow(document.getElementById('home-gallery'));
		home_slideshow.init();
	};

	var updateBridesmaidsCount = function(count) {
		var row = document.getElementById('bridesmaid-row'), clone;
		var rows = Array.from(row.parentNode.children);
		if (count < rows.length) rows.slice(count).forEach(function(row) { row.remove(); });
		if (count > rows.length) for (var i = rows.length + 1; i <= count; i++) {
			clone = row.cloneNode(true);
			clone.id = '';
			clone.querySelector('input').value = '';
			clone.querySelector('input').name = row.querySelector('input').name.replace('1', i);
			row.parentNode.appendChild(clone);
		}
	};
	
	var updateBridesmaidsNames = function() {
		document.querySelector('.wpcf7-form')["bridesmaids-names"].value = Array.from(document.getElementById('bridesmaid-row').parentNode.getElementsByTagName('input')).map(function(input) { return input.value; }).filter(function(value) { return value.length; }).join(',');
	};

	var initForms = function() {
		var count = document.getElementById('bridesmaids-count');
		if (count) {
			count.addEventListener('change', function(e) {
				updateBridesmaidsCount(count.value ? Math.max(1, parseInt(count.value, 10)) : 1);
				updateBridesmaidsNames();
			});
			document.querySelector('.wpcf7-form').addEventListener('change', function(e) {
				if (e.target.name.indexOf('bridesmaid-name') === 0) updateBridesmaidsNames();
			});
		}
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

	var initAppointmentSlider = function() {
		var sliders = Array.from(document.getElementsByClassName('widget_appointment-slider_widget')).map(function(node) { return new AppointmentSlider(node); });
		Array.from(document.getElementsByClassName('appointments-button')).forEach(function(button) {
			button.addEventListener('click', function(e) {
				e.preventDefault();
				sliders.forEach(function(slider) { return slider.open(); });
			});
		});
	};

	var init = function() {
		initMenu();
		if (document.body.classList.contains('home')) initHome();
		if (document.body.classList.contains('page-id-16')) initFaq();
		if (document.getElementsByClassName('wpcf7-form').length) initForms();
		initAppointmentSlider();
	};

	var onload = function() {
		if (home_slideshow) {
			home_slideshow.selectByIndex(0);
			home_slideshow.container.classList.add('init');
		}
		onresize();
	};

	var onresize = function() {
		if (home_slideshow) home_slideshow.resize();
		vw = document.documentElement.clientWidth;
		vh = document.documentElement.clientHeight;
		if (home_slideshow) home_slideshow.resize(vw, vh);
	}.throttle(100, { leading: false });

	var buttonTriggers = {

		classnameToggler: function(button) {
			var target = document.getElementById(button.dataset.target);
			target.classList.toggle(button.dataset.classname);
		}

	};

	return {
		init: init,
		onload: onload,
		onresize: onresize,
		buttonTriggers: buttonTriggers
	};

})();
