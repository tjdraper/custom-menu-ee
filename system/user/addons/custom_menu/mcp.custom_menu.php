<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Menu control panel
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

use BuzzingPixel\CustomMenu\Service\McpSidebar;

class Custom_menu_mcp
{
	/**
	 * Custom_menu_mcp constructor
	 */
	public function __construct()
	{
		McpSidebar::render();
	}

	/**
	 * Custom_menu_mcp CP index
	 */
	public function index()
	{
		return 'asdf';
	}
}
