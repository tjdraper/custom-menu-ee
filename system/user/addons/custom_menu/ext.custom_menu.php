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

	// Extension settings
	private $settings;

	/**
	 * Constructor
	 */
	public function __construct($settings)
	{
		$this->settings = $settings;
	}

	/**
	 * cp_css_end
	 *
	 * This needs to stay here for the extension hook call until update
	 */
	public function cp_css_end()
	{
		return '';
	}

	/**
	 * cp_js_end
	 *
	 * This needs to stay here for the extension hook call until update
	 */
	public function cp_js_end()
	{
		return '';
	}

	/**
	 * cp_js_end
	 */
	public function cp_custom_menu($menu)
	{
		// Get the site ID
		$siteId = (int) ee()->config->item('site_id');

		// Get the user group ID
		$groupId = (int) ee()->session->userdata('group_id');

		// Get this user groups settings
		$groupSettings = isset($this->settings[$siteId][$groupId]) ?
			$this->settings[$siteId][$groupId] : array();

		// If there are no group settings there's no point going on
		if (! $groupSettings) {
			return;
		}

		// Build CP URLs
		foreach ($groupSettings as $key => $val) {
			$menu->addItem(
				$val['name'],
				ee('CP/URL', $val['url'])
			);
		}
	}
}
