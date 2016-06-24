(function(F, S) {
	'use strict';

	F.fn.make('settings', {
		init: function() {
			var self = this;

			// Init row adding
			self.addRow();

			// Init add sub row
			self.addSubRow();

			// Init row deleting
			self.deleteRow();

			// Init sub row deleteing
			self.deleteSubRow();

			// Init sorting
			self.sorting();

			// Init sub row sorting
			$('.js-sortable-sub-container').each(function() {
				self.subRowSorting($(this));
			});
		},

		addRow: function() {
			var self = this;
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

				// Add row id data
				$newRow.attr('data-row-key', newRowId);

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

				// Init sorting on sub rows
				self.subRowSorting($newRow.find('.js-sortable-sub-container'));
			});
		},

		addSubRow: function() {
			var self = this;
			var $body = $('body');

			$body.on('click', '.js-add-sub-menu-item', function(e) {
				// Prevent window jumping
				e.preventDefault();

				// Go to common function
				self.addSubRowCommon($(this).closest('.js-sub-tbody'));
			});

			$body.on('click', '.js-add-sub-menu-item-outer', function(e) {
				// Prevent window jumping
				e.preventDefault();

				// Go to common function
				self.addSubRowCommon(
					$(this).parent('.js-toolbar').siblings('.js-sub-table').find('.js-sub-tbody')
				);
			});
		},

		addSubRowCommon: function($tbody) {
			// Get the no results row
			var $noResults = $tbody.find('.js-no-sub-results');

			// Get blank row
			var $blankRow = $tbody.find('.js-blank-sub-row');

			// Clone the blank row
			var $newRow = $blankRow.clone();

			// Create random hash
			var newRowId = Math.floor((Math.random() * 99999999999) + 1);

			// Get parent row ID
			var parentRowId = $tbody.closest('.js-row').data('rowKey');

			// Remove the blank row class and add the row class
			$newRow.jsShow().removeClass('js-blank-sub-row')
				.addClass('js-sub-row');

			// Add name attribute to inputs
			$newRow.find('.js-sub-menu-name').attr(
				'name',
				'custom_menu[rows][' + parentRowId + '][subMenu][' + newRowId + '][name]'
			);
			$newRow.find('.js-sub-menu-url').attr(
				'name',
				'custom_menu[rows][' + parentRowId + '][subMenu][' + newRowId + '][url]'
			);

			// Insert the row on the DOM
			$tbody.append($newRow);

			// Hide the no results row
			$noResults.jsHide();
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

		deleteSubRow: function() {
			$('body').on('click', '.js-remove-sub-menu-item', function(e) {
				// Cast $this
				var $this = $(this);

				// Get the row
				var $tbody = $this.closest('.js-sub-tbody');

				// Get the no results row
				var $noResults = $tbody.find('.js-no-sub-results');

				// Prevent window jumping
				e.preventDefault();

				// Delete the row from the DOM
				$(this).closest('.js-sort-sub-row').remove();

				// If there are no more rows, show the the no results row
				if (! $tbody.find('.js-sub-row').length) {
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
		},

		subRowSorting: function($tbody) {
			var $body = $('body');

			S.create($tbody[0], {
				handle: '.js-sort-sub-handle',
				draggable: '.js-sort-sub-row',
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
