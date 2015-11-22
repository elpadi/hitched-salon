(function() {
	var onDOMReady = function() {
		Hitched.init();
	};

	var onLoad = function() {
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
})();
