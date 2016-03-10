(function(F) {
	'use strict';

	// Define FAB lang functions
	var runLang = function() {
		// Set lang variables
		$('[data-lang]').each(function() {
			var $el = $(this);

			F.lang[$el.data('lang')] = $el.data('value');
		});

		/**
		 * Method for setting lang vars
		 *
		 * @param {string} langName - Name of the variable to set
		 * @param {*} value - Value to set for this global var
		 */
		F.$langSet = function(langName, value) {
			F.lang[langName] = value;
		};

		/**
		 * Method for getting lang vars
		 *
		 * @param {string} langName - Name of lang variable to get
		 * @param {string} [defaultVal] - Default value to return if no var
		 * @return {(string|null)} - Lang value, default value, or null
		 */
		F.$lang = function(langName, defaultVal) {
			if (
				F.lang[langName] !== null &&
				F.lang[langName] !== undefined
			) {
				return F.lang[langName];
			}

			return defaultVal || null;
		};
	};

	// Run langVars when DOM ready
	$(function() {
		runLang();
	});
})(window.CUSTOM_MENU);
