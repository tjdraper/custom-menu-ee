<?php

/**
 * Custom Menu Installer controller
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

		// Add cp_custom_menu extension
		$cpCustomMenuExt = ee('Model')->make('Extension', array(
			'class' => 'Custom_menu_ext',
			'method' => 'cp_custom_menu',
			'hook' => 'cp_custom_menu',
			'settings' => $settings,
			'version' => $this->appInfo->getVersion(),
			'enabled' => 'y'
		));

		// Save the extension
		$cpCustomMenuExt->save();
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
			->filter('module_name', 'Custom_menu')
			->all();

		$module->module_version = $this->appInfo->getVersion();

		$module->save();

		// Update the extension version
		$extension = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->all();

		$extension->version = $this->appInfo->getVersion();

		$extension->save();
	}

	/**
	 * Update to 1.0.0
	 */
	public function updateTo1_0_0()
	{
		// Get cp_js_end extension
		$cpJsEnd = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('method', 'cp_js_end')
			->first();

		// Get the cp_js_end settings
		$settings = $cpJsEnd->settings;

		// Get cp_css_end and cp_js_end extensions
		$extensions = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('method', 'IN', array(
				'cp_css_end',
				'cp_js_end'
			))
			->all();

		// Delete extensions
		$extensions->delete();

		// Add cp_custom_menu extension
		$cpCustomMenuExt = ee('Model')->make('Extension', array(
			'class' => 'Custom_menu_ext',
			'method' => 'cp_custom_menu',
			'hook' => 'cp_custom_menu',
			'settings' => $settings,
			'version' => $this->appInfo->getVersion(),
			'enabled' => 'y'
		));

		// Save the extension
		$cpCustomMenuExt->save();
	}
}
