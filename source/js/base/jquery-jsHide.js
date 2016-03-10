(function($) {
	$.fn.jsHide = function() {
		this.addClass('js-hide');
		return this;
	};

	$.fn.jsShow = function() {
		this.removeClass('js-hide');
		return this;
	};
})(window.jQuery);
