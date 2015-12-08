var Slideshow = (function () {
	function Slideshow(container) {
		_classCallCheck(this, Slideshow);

		this.container = container;
		this.images = container.getElementsByClassName('slideshow__image');
		if (this.images.length === 0) this.images = container.getElementsByTagName('img');
		this.buttons = container.getElementsByTagName('button');
		this.currentIndex = -1;
	}

	_createClass(Slideshow, [{
		key: 'deselectIndex',
		value: function deselectIndex(index) {
			this.hideImage(index);
			this.deselectButton(index);
		}
	}, {
		key: 'selectIndex',
		value: function selectIndex(index) {
			this.showImage(index);
			this.selectButton(index);
		}
	}, {
		key: 'showImage',
		value: function showImage(index) {
			this.images[index].classList.add('selected');
		}
	}, {
		key: 'hideImage',
		value: function hideImage(index) {
			this.images[index].classList.remove('selected');
		}
	}, {
		key: 'getButtonsByIndex',
		value: function getButtonsByIndex(index) {
			return Array.prototype.filter.call(this.buttons, function (b) {
				return b.dataset.index == index;
			});
		}
	}, {
		key: 'deselectButton',
		value: function deselectButton(index) {
			this.getButtonsByIndex(index).forEach(function (b) {
				return b.classList.remove('selected');
			});
		}
	}, {
		key: 'selectButton',
		value: function selectButton(index) {
			this.getButtonsByIndex(index).forEach(function (b) {
				return b.classList.add('selected');
			});
		}
	}, {
		key: 'selectByIndex',
		value: function selectByIndex(index) {
			if (index < 0 || index >= this.images.length) {
				throw new RangeError("Bad index.");
			}
			if (index !== this.currentIndex) {
				try {
					if (this.currentIndex >= 0) this.deselectIndex(this.currentIndex);
					this.selectIndex(index);
				} catch (e) {
					console.error(e);
					return false;
				}
				this.currentIndex = index;
			}
		}
	}, {
		key: 'init',
		value: function init() {
			var _this = this;

			this.container.addEventListener('click', function (e) {
				var index;
				if (e.target.nodeName === 'BUTTON' && !isNaN(index = parseInt(e.target.dataset.index, 10)) && _this.selectByIndex(index)) {
					e.preventDefault();
				}
			});
		}
	}, {
		key: 'start',
		value: function start() {
			this.selectByIndex(0);
			this.container.classList.add('init');
		}
	}, {
		key: 'resize',
		value: function resize() {
			Array.prototype.map.call(this.images, function (img) {
				return img.nodeName === 'IMG' ? img : img.getElementsByTagName('img')[0];
			}).forEach(function (img) {
				return img.cover();
			});
		}
	}, {
		key: 'load',
		value: function load() {
			this.resize();
			setTimeout(this.start.bind(this), 16);
		}
	}]);

	return Slideshow;
})();

var HorizontalWrappingSlideshow = (function (_Slideshow) {
	_inherits(HorizontalWrappingSlideshow, _Slideshow);

	function HorizontalWrappingSlideshow(container) {
		_classCallCheck(this, HorizontalWrappingSlideshow);

		_get(Object.getPrototypeOf(HorizontalWrappingSlideshow.prototype), 'constructor', this).call(this, container);
		this.EDGE = 50;
		this.SPACING = 140;
		this.imagesByPosition = [];
		this.leftIndex = 0;
		this.switchTimeoutId = 0;
	}

	_createClass(HorizontalWrappingSlideshow, [{
		key: 'init',
		value: function init() {
			var _this2 = this;

			this.container.addEventListener('click', function (e) {
				var img = e.target;
				while (!(img.nodeName === 'SECTION' || img.nodeName === 'ARTICLE')) img = img.parentNode;
				if (img.nodeName !== 'SECTION') {
					var posIndex = _this2.imagesByPosition.indexOf(img);
					console.log('HorizontalWrappingSlideshow.onImageClick', posIndex);
					if (posIndex !== -1 && posIndex !== 1) _this2.selectByIndex(_this2.currentIndex + posIndex - 1);
				}
			});
		}
	}, {
		key: 'wrappedIndex',
		value: function wrappedIndex(index) {
			return (this.images.length + index) % this.images.length;
		}
	}, {
		key: 'edgeLeft',
		value: function edgeLeft() {
			var imageIndex = this.wrappedIndex(this.leftIndex - 1);
			this.images[imageIndex].style.left = (this.width + this.SPACING) * (this.leftIndex - 1) + 'px';
			this.imagesByPosition[0] = this.images[imageIndex];
			this.leftIndex--;
		}
	}, {
		key: 'edgeRight',
		value: function edgeRight() {
			var imageIndex = this.wrappedIndex(this.leftIndex);
			this.images[imageIndex].style.left = (this.width + this.SPACING) * imageIndex + 'px';
			this.imagesByPosition[2] = this.images[imageIndex];
			this.leftIndex++;
		}
	}, {
		key: 'moveViewport',
		value: function moveViewport(x) {
			console.log('HorizontalWrappingSlideshow.moveViewport', x);
			this.images[0].parentNode.style.transform = 'translateX(' + x + 'px)';
		}
	}, {
		key: 'enableRollover',
		value: function enableRollover() {
			var _this3 = this;

			window.addEventListenerOnce('mousemove', function () {
				return _this3.imagesByPosition[1].classList.add('selected');
			});
		}
	}, {
		key: 'selectByIndex',
		value: function selectByIndex(index) {
			console.log('HorizontalWrappingSlideshow.selectByIndex', index);
			if (this.imagesByPosition.length) {
				this.imagesByPosition[1].classList.remove('selected');
				clearTimeout(this.switchTimeoutId);
				this.switchTimeoutId = setTimeout(this.enableRollover.bind(this), 500);
			} else {
				this.container.classList.add('init');
				this.images[this.wrappedIndex(index)].classList.add('selected');
			}

			if (index === this.leftIndex) this.edgeLeft();else this.imagesByPosition[0] = this.images[this.wrappedIndex(index - 1)];

			if (index === this.images.length - 1 + this.leftIndex) this.edgeRight();else this.imagesByPosition[2] = this.images[this.wrappedIndex(index + 1)];

			this.moveViewport(this.EDGE + this.SPACING - (this.width + this.SPACING) * index);
			this.imagesByPosition[1] = this.images[this.wrappedIndex(index)];

			this.currentIndex = index;
		}
	}, {
		key: 'resize',
		value: function resize() {
			var _this4 = this;

			_get(Object.getPrototypeOf(HorizontalWrappingSlideshow.prototype), 'resize', this).call(this);
			this.width = App.instance.vw - (this.SPACING + this.EDGE) * 2;
			Array.from(this.images).forEach(function (img, index) {
				img.style.left = (_this4.width + _this4.SPACING) * index + 'px';
			});
		}
	}, {
		key: 'start',
		value: function start() {
			this.selectByIndex(0);
		}
	}]);

	return HorizontalWrappingSlideshow;
})(Slideshow);

var HomeSlideshow = (function (_Slideshow) {
	_inherits(HomeSlideshow, _Slideshow);

	function HomeSlideshow(container) {
		_classCallCheck(this, HomeSlideshow);

		_get(Object.getPrototypeOf(HomeSlideshow.prototype), 'constructor', this).call(this, container);
		this.autoSwitchDuration = 5000;
		this.timeoutId = 0;
	}

	_createClass(HomeSlideshow, [{
		key: 'resetTimer',
		value: function resetTimer() {
			clearTimeout(this.timeoutId);
			this.timeoutId = setTimeout(this.selectByIndex.curry((this.currentIndex + 1) % this.images.length).bind(this), this.autoSwitchDuration);
		}
	}, {
		key: 'selectByIndex',
		value: function selectByIndex(index) {
			_get(Object.getPrototypeOf(HomeSlideshow.prototype), 'selectByIndex', this).call(this, index);
			this.resetTimer();
		}
	}, {
		key: 'pause',
		value: function pause() {
			clearTimeout(this.timeoutId);
		}
	}, {
		key: 'resume',
		value: function resume() {
			this.resetTimer();
		}
	}, {
		key: 'load',
		value: function load() {}
	}]);

	return HomeSlideshow;
})(Slideshow);
