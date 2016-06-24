<table cellspacing="0" class="grid-input-form cust-menu-sub-table js-sub-table">
	<thead>
		<tr>
			<th class="first reorder-col"></th>
			<th class="cust-menu-table__sub-menu-name">Title</th>
			<th>Link</th>
			<th class="last grid-remove cust-menu-table__main-menu-remove"></th>
		</tr>
	</thead>
	<tbody class="js-sub-tbody js-sortable-sub-container">
		<tr class="no-results js-no-sub-results<?php if ($subSettings) { ?> js-hide<?php } ?>">
			<td class="solo" colspan="4">
				<?= lang('no_menu_items') ?> <a class="btn action js-add-sub-menu-item" href="#"><?= lang('add_menu_item') ?></a>
			</td>
		</tr>
		<tr class="js-sort-sub-row js-blank-sub-row js-hide">
			<td class="reorder-col js-sort-sub-handle"><span class="ico reorder"></span></td>
			<td>
				<input type="text" class="js-sub-menu-name">
			</td>
			<td>
				<input type="text" class="js-sub-menu-url">
			</td>
			<td>
				<ul class="toolbar">
					<li class="remove js-remove-sub-menu-item"><a href="#" title="remove row"></a></li>
				</ul>
			</td>
		</tr>
		<?php foreach ($subSettings as $subKey => $subVal) { ?>
			<tr class="js-sort-sub-row js-sub-row">
				<td class="reorder-col js-sort-handle"><span class="ico reorder"></span></td>
				<td>
					<input
						type="text" class="js-sub-menu-name"
						name="custom_menu[rows][<?= $key ?>][subMenu][<?= $subKey ?>][name]"
						value="<?= $subVal['name'] ?>"
					>
				</td>
				<td>
					<input
						type="text"
						class="js-sub-menu-url"
						name="custom_menu[rows][<?= $key ?>][subMenu][<?= $subKey ?>][url]"
						value="<?= $subVal['url'] ?>"
					>
				</td>
				<td>
					<ul class="toolbar">
						<li class="remove js-remove-sub-menu-item"><a href="#" title="remove row"></a></li>
					</ul>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<br>
<ul class="toolbar js-toolbar" style="">
	<li class="add js-add-sub-menu-item-outer"><a href="#" title="add new row"></a></li>
</ul>
