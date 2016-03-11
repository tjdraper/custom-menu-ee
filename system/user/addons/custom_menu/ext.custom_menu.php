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
		// Get any previous items set on this extension call
		$js = ee()->extensions->last_call ?: '';

		// Get the user group ID
		$groupId = (int) ee()->session->userdata('group_id');

		// Get the extension settings
		$extSettings = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('hook', 'cp_js_end')
			->first()
			->settings ?: array();

		// Get this user groups settings
		$groupSettings = isset($extSettings[$groupId]) ?
			$extSettings[$groupId] : array();

		// If there are no group settings there's no point going on
		if (! $groupSettings) {
			return $js;
		}

		// Build CP URLs
		foreach ($groupSettings as $key => $val) {
			$url = ee('CP/URL', $val['url'])->compile();
			$groupSettings[$key]['url'] = $url;
		}

		// Json encode menu items
		$settings = json_encode(array_values($groupSettings));

		// Output a JS variable of the menu items
		$js .= "window.CUSTOM_MENU_ITEMS = {$settings};";

		// Get the JS for this extension
		$js .= file_get_contents(
			PATH_THIRD . 'custom_menu/javascript/cp_js_end.js'
		);

		// Return the JS
		return $js;
	}
}
