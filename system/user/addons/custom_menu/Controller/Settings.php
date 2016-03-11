<?php

/**
 * Custom Menu Settings controller
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

namespace BuzzingPixel\CustomMenu\Controller;

class Settings
{
	/**
	 * Render settings page
	 */
	public function render()
	{
		// Get active group ID
		$activeGroupId = (int) end(ee()->uri->segments);

		// If there is no group ID, get the first one
		if (! $activeGroupId) {
			$activeGroupId = (int) ee('Model')->get('MemberGroup')
				->filter('can_access_cp', 'y')
				->order('group_id', 'ASC')
				->first()
				->group_id;
		}

		// Get the extension settings
		$moduleSettings = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('hook', 'cp_js_end')
			->first()
			->settings ?: array();

		$groupSettings = isset($moduleSettings[$activeGroupId]) ?: array();

		return array(
			'body' => ee('View')->make('custom_menu:Settings')->render(compact(
				'groupSettings'
			))
		);
	}
}
