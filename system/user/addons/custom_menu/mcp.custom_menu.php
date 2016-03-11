<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Menu control panel
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

use BuzzingPixel\CustomMenu\Helper\CpCssJs;
use BuzzingPixel\CustomMenu\Service\McpSidebar;
use BuzzingPixel\CustomMenu\Controller\Settings;

class Custom_menu_mcp
{
	/**
	 * Custom_menu_mcp constructor
	 */
	public function __construct()
	{
		CpCssJs::add();
		McpSidebar::render();
	}

	/**
	 * Custom_menu_mcp CP index
	 */
	public function index()
	{
		$settings = new Settings();

		if ($_POST) {
			$settings->save();
		}

		return $settings->render();
	}
}
