<?php

/**
 * CpCssJs helper
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

namespace BuzzingPixel\CustomMenu\Helper;

class CpCssJs
{
	/**
	 * Render the sidebar
	 */
	public static function add()
	{
		// Add CSS
		$css = URL_THIRD_THEMES . 'custom_menu/css/style.min.css';
		ee()->cp->add_to_head("<link rel=\"stylesheet\" href=\"{$css}\">");

		// Add JS
		$js = URL_THIRD_THEMES . 'custom_menu/js/script.min.js';
		ee()->cp->add_to_foot(
			"<script type=\"text/javascript\" src=\"{$js}\"></script>"
		);
	}
}
