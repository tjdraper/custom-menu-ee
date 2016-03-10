<?php

/**
 * Custom Menu controller
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

namespace BuzzingPixel\CustomMenu\Controller;

class Installer
{
	// EE App Info
	protected $appInfo;

	/**
	 * Installer constructor
	 *
	 * @param $appInfo The extension provider object
	 */
	public function __construct(
		\EllisLab\ExpressionEngine\Core\Provider $appInfo
	)
	{
		$this->appInfo = $appInfo;
	}

	/**
	 * Install
	 */
	public function install()
	{
		// Install module
		ee('Model')->make('Module')->set(array(
			'module_name' => 'Custom_menu',
			'module_version' => $this->appInfo->getVersion(),
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		))->save();

		// Install cp_css_end hook
		ee('Model')->make('Extension')->set(array(
			'class' => 'Custom_menu_ext',
			'method' => 'cp_css_end',
			'hook' => 'cp_css_end',
			'settings' => '',
			'version' => $this->appInfo->getVersion()
		))->save();

		// Install cp_js_end hook
		ee('Model')->make('Extension')->set(array(
			'class' => 'Custom_menu_ext',
			'method' => 'cp_js_end',
			'hook' => 'cp_js_end',
			'settings' => '',
			'version' => $this->appInfo->getVersion()
		))->save();
	}

	/**
	 * Uninstall
	 */
	public function uninstall()
	{
		// Delete the module
		ee('Model')->get('Module')
			->filter('module_name', 'Custom_menu')
			->all()
			->delete();

		// Delete the extensions
		ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->all()
			->delete();
	}

	/**
	 * General update routines
	 */
	public function generalUpdate()
	{
		// Update the module version
		$module = ee('Model')->get('Module')
			->filter('class', 'Custom_menu_ext')
			->all();

		$module->version = $this->appInfo->getVersion();

		$module->save();

		// Update the extension version
		$extension = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->all();

		$extension->version = $this->appInfo->getVersion();

		$extension->save();
	}
}
