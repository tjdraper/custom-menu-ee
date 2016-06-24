<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Menu installer/updater
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

use BuzzingPixel\CustomMenu\Controller\Installer;

class Custom_menu_upd
{
	public $name = CUSTOM_MENU_NAME;
	public $version = CUSTOM_MENU_VER;

	private $installer;
	private $appInfo;

	/**
	 * Ansel_upd constructor
	 */
	public function __construct()
	{
		$this->appInfo = ee('App')->get('custom_menu');
		$this->installer = new Installer($this->appInfo);
	}

	/**
	 * Install
	 *
	 * @return bool
	 */
	public function install()
	{
		$this->installer->install();
		return true;
	}

	/**
	 * Uninstall
	 *
	 * @return bool
	 */
	public function uninstall()
	{
		$this->installer->uninstall();
		return true;
	}

	/**
	 * Update
	 *
	 * @param string $current The current version before update
	 * @return bool
	 */
	public function update($current = '')
	{
		// Check if any update is needed
		if ($current === $this->version) {
			return false;
		}

		// If the current version is less than 1.0.0, we need extension updates
		if (version_compare($current, '1.0.0', '<')) {
			$this->installer->updateTo1_0_0();
		}

		// Run general update routines
		$this->installer->generalUpdate();

		// All done here
		return true;
	}
}
