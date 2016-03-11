(function(M) {
	'use strict';

	var $authorMenu = $('.author-menu');
	var $menuItem = $('<li></li>');
	var $btn = $('<a href class="has-sub">More&hellip;</a>');
	var $sub = $('<div class="sub-menu"></div>');
	var $ul = $('<ul></ul>');

	// If there are no items in the array we don't need to do anything
	if (! M.length) {
		return;
	}

	// Build elements and place on DOM
	$authorMenu.append($menuItem);
	$menuItem.append($btn);
	$menuItem.append($sub);
	$sub.append($ul);

	// Loop through each of the menu items and place them
	M.forEach(function(i) {
		$ul.append('<li><a href="' + i.url + '">' + i.name + '</a>');
	});
})(window.CUSTOM_MENU_ITEMS);
