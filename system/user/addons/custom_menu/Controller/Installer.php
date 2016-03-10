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
		$extension = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->all();

		$extension->version = $this->appInfo->getVersion();

		$extension->save();
	}
}
