(function() {
	var onDOMReady = function() {
		Hitched.init();
	};

	var onLoad = function() {
		Hitched.onload();
		Hitched.onresize();
	};

	var onResize = function() {
		Hitched.onresize();
	};
	
	if (document.readyState !== 'loading') {
		console.log('content loaded, straight to dom ready');
		onDOMReady();
		onLoad();
	}
	else {
		console.log('content not loaded yet, attach to dom ready event');
		document.addEventListener("DOMContentLoaded", onDOMReady);
		window.addEventListener('load', onLoad);
	}
	window.addEventListener('resize', onResize);

	document.addEventListener('click', function(e) {
		['classnameToggler'].forEach(function(className) {
			if (e.target.classList.contains(className)) Hitched.buttonTriggers[className].call(this, e.target);
		});
	});
})();
