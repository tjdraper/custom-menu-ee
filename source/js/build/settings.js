(function(F, S) {
	'use strict';

	F.fn.make('settings', {
		init: function() {
			var _this = this;

			// Init row adding
			_this.addRow();

			// Init row deleting
			_this.deleteRow();

			// Init sorting
			_this.sorting();
		},

		addRow: function() {
			var $tbody = $('.js-tbody');
			var $noResults = $('.js-no-results');
			var $blankRow = $('.js-blank-row');

			// When the add button is clicked
			$('.js-add-menu-item').on('click', function(e) {
				// Clone the blank row
				var $newRow = $blankRow.clone();

				// Create random hash
				var newRowId = Math.floor((Math.random() * 99999999999) + 1);

				// Prevent window jumping
				e.preventDefault();

				// Remove the blank row class and add the row class
				$newRow.jsShow().removeClass('js-blank-row').addClass('js-row');

				// Add name attribute to inputs
				$newRow.find('.js-menu-name')
					.attr('name', 'custom_menu[rows][' + newRowId + '][name]');

				$newRow.find('.js-menu-url')
					.attr('name', 'custom_menu[rows][' + newRowId + '][url]');

				// Insert the row on the DOM
				$tbody.append($newRow);

				// Hide the no results row
				$noResults.jsHide();
			});
		},

		deleteRow: function() {
			var $noResults = $('.js-no-results');

			// When the delete row button is clicked
			$('.js-tbody').on('click', '.js-remove-menu-item', function(e) {
				// Prevent window jumping
				e.preventDefault();

				// Delete the row from the DOM
				$(this).closest('.js-row').remove();

				// If there are no more rows, show the the no results row
				if (! $('.js-row').length) {
					$noResults.jsShow();
				}
			});
		},

		sorting: function() {
			var $body = $('body');

			S.create($('.js-sortable-container')[0], {
				handle: '.js-sort-handle',
				draggable: '.js-sort-row',
				forceFallback: true,
				fallbackClass: 'sortable-dragger',
				disableXAxis: true,
				onStart: function() {
					$body.addClass('ansel-dragging');
				},
				onEnd: function() {
					$body.removeClass('ansel-dragging');
				}
			});
		}
	});
})(window.CUSTOM_MENU, window.Sortable);
