<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Menu extension
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

use BuzzingPixel\CustomMenu\Controller\Installer;

class Custom_menu_ext
{
	// Set the version for ExpressionEngine
	public $version = CUSTOM_MENU_VER;

	/**
	 * cp_css_end
	 */
	public function cp_css_end()
	{
		return '';
	}

	/**
	 * cp_js_end
	 */
	public function cp_js_end()
	{
		return '';
	}
}
