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

Object.defineProperty(AppointmentSlider.prototype, 'open', {
	value: function() {
		this.container.classList.add('visible');
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'close', {
	value: function() {
		this.container.classList.remove('visible');
		this.formButtons.forEach(function(button) { this.deselect(button); }.bind(this));
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'load', {
	value: function(button) {
		button.classList.add('loading');
		button.style.backgroundImage = 'url(' + WP.WP_URL + '/wp-admin/images/loading.gif)';
		button.dataset.timeoutId = setTimeout(function() {
			button.classList.remove('loading');
		}, 5000);
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'select', {
	value: function(button) {
		var deselect = this.deselect.bind(this);
		button.classList.add('selected');
		if (!('appointmentForm' in button.dataset)) this.load(button);
		this.formButtons.filter(function(b) { return b !== button; }).forEach(function(b) { deselect(b); });
	}
});

Object.defineProperty(AppointmentSlider.prototype, 'deselect', {
	value: function(button) {
		button.classList.remove('selected');
		if (button.classList.contains('loading')) {
			button.classList.remove('loading');
			clearTimeout(button.dataset.timeoutId);
		}
	}
});
