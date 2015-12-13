'use strict';

var _get = function get(_x, _x2, _x3) { var _again = true; _function: while (_again) { var object = _x, property = _x2, receiver = _x3; desc = parent = getter = undefined; _again = false; if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { _x = parent; _x2 = property; _x3 = receiver; _again = true; continue _function; } } else if ('value' in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } } };

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _inherits(subClass, superClass) { if (typeof superClass !== 'function' && superClass !== null) { throw new TypeError('Super expression must either be null or a function, not ' + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

Object.defineProperty(Function.prototype, 'curry', {
	value: function () {
		for (var _len = arguments.length, saved = Array(_len), _key = 0; _key < _len; _key++) {
			saved[_key] = arguments[_key];
		}

		var fn = this;
		return function () {
			return fn.apply(this, saved.concat(Array.from(arguments)));
		};
	}
});

Object.defineProperty(Function.prototype, 'throttle', {
	value: function(wait, options) {
		var func = this;
		var context, args, result;
		var timeout = null;
		var previous = 0;
		if (!options) options = {};
		var later = function() {
			previous = options.leading === false ? 0 : Date.now();
			timeout = null;
			result = func.apply(context, args);
			if (!timeout) context = args = null;
		};
		return function() {
			var now = Date.now();
			if (!previous && options.leading === false) previous = now;
			var remaining = wait - (now - previous);
			context = this;
			args = arguments;
			if (remaining <= 0 || remaining > wait) {
				if (timeout) {
					clearTimeout(timeout);
					timeout = null;
				}
				previous = now;
				result = func.apply(context, args);
				if (!timeout) context = args = null;
			} else if (!timeout && options.trailing !== false) {
				timeout = setTimeout(later, remaining);
			}
			return result;
		};
	}
});

var Point = function Point(x, y) {
	_classCallCheck(this, Point);

	this.x = typeof x === 'number' ? x : 0;
	this.y = typeof y === 'number' ? y : 0;
	if (typeof x === 'object' && 'x' in x) {
		this.x = x.x;
		this.y = x.y;
	}
};

var Rect = (function (_Point) {
	_inherits(Rect, _Point);

	function Rect(x, y, width, height) {
		_classCallCheck(this, Rect);

		_get(Object.getPrototypeOf(Rect.prototype), 'constructor', this).call(this, x, y);
		this.width = typeof width === 'number' ? width : 0;
		this.height = typeof height === 'number' ? height : 0;
		if (typeof x === 'object' && 'width' in x) {
			this.width = x.width;
			this.height = x.height;
		}
		this.aspectRatio = this.height > 0 ? this.width / this.height : NaN;
		// console.log('rect', this);
	}

	_createClass(Rect, [{
		key: 'center',
		value: function center(rect) {
			this.x = Math.round((rect.width - this.width) / 2) + rect.x;
			this.y = Math.round((rect.height - this.height) / 2) + rect.y;
			// console.log('center', this, rect);
			return this;
		}
	}, {
		key: 'contain',
		value: function contain(rect) {
			if (this.aspectRatio > rect.aspectRatio) {
				this.width = rect.width;
				this.height = Math.round(rect.width / this.aspectRatio);
			} else {
				this.width = Math.round(rect.height * this.aspectRatio);
				this.height = rect.height;
			}
			return this;
		}
	}, {
		key: 'cover',
		value: function cover(rect) {
			if (this.aspectRatio < rect.aspectRatio) {
				this.width = rect.width;
				this.height = Math.round(rect.width / this.aspectRatio);
			} else {
				this.width = Math.round(rect.height * this.aspectRatio);
				this.height = rect.height;
			}
			// console.log('cover', this, rect);
			return this;
		}
	}]);

	return Rect;
})(Point);

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

Object.defineProperty(HTMLImageElement.prototype, 'cover', {
	value: function() {
		if (this.naturalWidth === 0) {
			setTimeout(this.cover.bind(this), 16);
			return;
		}
		if (!this.offsetParent) return;
		var outer = new Rect(this.offsetParent.getBoundingClientRect());
		var inner = new Rect(0, 0, this.naturalWidth, this.naturalHeight);
		outer.x = outer.y = 0;
		inner.cover(outer).center(outer);
		// console.log(inner);
		this.style.left = inner.x + 'px';
		this.style.top = inner.y + 'px';
		this.style.width = inner.width + 'px';
		this.style.height = inner.height + 'px';
		this.offsetParent.style.overflow = 'hidden';
	}
});
