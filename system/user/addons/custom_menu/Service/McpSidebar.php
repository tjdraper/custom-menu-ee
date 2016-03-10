<?php

/**
 * McpSidebar service
 *
 * @package custom_menu
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

namespace BuzzingPixel\CustomMenu\Service;

class McpSidebar
{
	/**
	 * Render the sidebar
	 */
	public static function render()
	{
		// Get active group ID
		$activeGroupId = (int) end(ee()->uri->segments);

		// Create the sidebar
		$sidebar = ee('CP/Sidebar')->make();

		// Add the heading
		$header = $sidebar->addHeader(lang('member_groups'));

		// Create a list under the header
		$list = $header->addBasicList();

		// Get member groups
		$memberGroups = ee('Model')->get('MemberGroup')
			->filter('can_access_cp', 'y')
			->order('group_id', 'ASC')
			->all();

		foreach ($memberGroups as $key => $memberGroup) {
			$item = $list->addItem(
				$memberGroup->group_title,
				ee('CP/URL', "addons/settings/custom_menu/index/{$memberGroup->group_id}")
			);

			if (! $activeGroupId && $key === 0) {
				$item->isActive();
			}
		}
	}
}
