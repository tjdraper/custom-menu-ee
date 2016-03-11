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
	 * Save settings
	 */
	public function save()
	{
		// Get the relevant post data
		$post = ee()->input->post('custom_menu');

		// Get the group ID
		$activeGroupId = (int) $post['active_group_id'];

		// Get the rows
		$rows = $post['rows'] ?: array();

		// Clean URL
		foreach ($rows as $key => $val) {
			// If name or URL is not set, remove row
			if (! $val['name'] || ! $val['url']) {
				unset($rows[$key]);
				continue;
			}

			// Remove session data
			$val['url'] = preg_replace('/&S=.*/', '', $val['url']);
			$val['url'] = trim(preg_replace('/^(.+)?(\.php\?\/?)?(cp\/)/', '', $val['url']), '/');
			$rows[$key] = $val;
		}

		// Get the extension
		$ext = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('hook', 'cp_js_end')
			->first();

		// Get the settings
		$extSettings = $ext->settings ?: array();

		// Update the settings
		$extSettings[$activeGroupId] = $rows;

		// Update the extension
		$ext->settings = $extSettings;

		// Save the extension
		$ext->save();

		// Show the success message
		ee('CP/Alert')->makeInline('custom-menu-settings-updated')
			->asSuccess()
			->canClose()
			->withTitle(lang('settings_upated_title'))
			->addToBody(lang('settings_upated'))
			->defer();

		// Redirect to this page
		ee()->functions->redirect(ee('CP/URL', "addons/settings/custom_menu/index/{$activeGroupId}"));
	}

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
		$extensionSettings = ee('Model')->get('Extension')
			->filter('class', 'Custom_menu_ext')
			->filter('hook', 'cp_js_end')
			->first()
			->settings ?: array();

		$groupSettings = isset($extensionSettings[$activeGroupId]) ?
			$extensionSettings[$activeGroupId] : array();

		return array(
			'body' => ee('View')->make('custom_menu:Settings')->render(compact(
				'activeGroupId',
				'groupSettings'
			))
		);
	}
}
