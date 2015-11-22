Object.defineProperty(EventTarget.prototype, 'addDelegatedEventListener', {
	value: function(type, test, listener) {
		var last = this;
		var _listener = function(e) {
			var el = e.target;
			while (!test(el) && el !== last) el = el.parentNode;
			if (test(el)) listener.call(el, e);
		};
		this.addEventListener(type, _listener);
		return _listener;
	}
});
