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

	protected $appInfo;

	/**
	 * Custom_menu_ext constructor
	 *
	 * @param array $settings
	 */
	public function __construct($settings = array())
	{
		$this->appInfo = ee('App')->get('custom_menu');
	}

	/**
	 * Install extension
	 */
	public function activate_extension()
	{
		$installer = new Installer($this->appInfo);
		$installer->install();
	}

	/**
	 * Uninstall extension
	 */
	public function disable_extension()
	{
		$installer = new Installer($this->appInfo);
		$installer->uninstall();
	}

	/**
	 * Update extension
	 */
	public function update_extension($current = '')
	{
		if ($current ===  $this->appInfo->getVersion()) {
			return false;
		}

		$installer = new Installer($this->appInfo);

		$installer->generalUpdate();

		return true;
	}

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
