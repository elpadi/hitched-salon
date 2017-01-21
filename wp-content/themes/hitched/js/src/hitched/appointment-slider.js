function AppointmentSlider(node) {
	var close = this.close.bind(this);
	var select = this.select.bind(this);
	this.container = node;
	Array.from(node.getElementsByClassName('close-button')).forEach(function(button) {
		button.addEventListener('click', close);
	});
	this.formButtons = Array.from(node.getElementsByClassName('form-buttons')[0].getElementsByTagName('button'));
	this.formButtons.forEach(function(button) { button.addEventListener('click', function(e) { select(button); }); });
}

Object.defineProperty(AppointmentSlider, 'SLIDE_DURATION', { value: 300 });
Object.defineProperty(AppointmentSlider, 'FADE_DURATION', { value: 200 });

Object.defineProperty(AppointmentSlider.prototype, 'open', {
	value: function() {
		this.container.classList.add('visible');
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'reset', {
	value: function() {
		this.formButtons.forEach(function(button) {
			this.deselect(button);
			if ('appointmentForm' in button) setTimeout(function() { button.appointmentForm.classList.remove('hidden'); }, AppointmentSlider.SLIDE_DURATION);
		}.bind(this));
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'close', {
	value: function() {
		this.container.classList.remove('visible');
		this.reset();
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'load', {
	value: function(button) {
		button.classList.add('loading');
		button.style.backgroundImage = 'url(' + WP.LOADING_SPINNER_URL + ')';
		jQuery.post(WP.AJAX_URL, {
			action: 'shortcode',
			shortcode: button.dataset.shortcode
		}, function(response) {
			this.onFormLoad(button, response);
		}.bind(this), 'html');
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'onFormLoad', {
	value: function(button, html) {
		if (button.classList.contains('loading')) {
			var div = document.createElement('div');
			div.innerHTML = html;
			var form = div.children[0].cloneNode(true);
			button.classList.remove('loading');
			this.container.firstChild.appendChild(form);
			setTimeout(function() {
				button.appointmentForm = form;
				jQuery(form).find('form').attr('action', location.href).wpcf7InitForm();
				form.classList.add('visible');
			}.bind(this), 100);
		}
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'select', {
	value: function(button) {
		var deselect = this.deselect.bind(this);
		var others = this.formButtons.filter(function(b) { return b !== button; });
		others.forEach(function(b) { deselect(b); });
		setTimeout(function() {
			button.classList.add('selected');
			if ('appointmentForm' in button) {
				button.appointmentForm.classList.remove('hidden');
				setTimeout(function() { button.appointmentForm.classList.add('visible'); }, 50);
			}
			else this.load(button);
		}.bind(this), others.some(function(b) { return ('appointmentForm' in button); }) ? AppointmentSlider.FADE_DURATION + 50 : 16);
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'cancel', {
	value: function(button) {
		button.classList.remove('loading');
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'deselect', {
	value: function(button) {
		button.classList.remove('selected');
		if ('appointmentForm' in button) {
			button.appointmentForm.classList.remove('visible');
			setTimeout(function() { button.appointmentForm.classList.add('hidden'); }, AppointmentSlider.FADE_DURATION);
		}
		if (button.classList.contains('loading')) {
			this.cancel(button);
		}
	}
});
