	var height_ = jQuery.fn.height;
	jQuery.fn.height = function() {
	if ( this[0] == window && jQuery.browser.opera && jQuery.browser.version >= 9.50 )
		return window.innerHeight;
	else
		return height_.apply(this,arguments);
	};
