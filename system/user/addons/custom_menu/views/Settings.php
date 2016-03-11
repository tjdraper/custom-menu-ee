<div class="box custom-menu-settings" data-set="pageType" data-value="settings">
	<?= form_open(false, array('class' => 'settings')) ?>
		<?= ee('CP/Alert')->getAllInlines() ?>
		<input type="hidden" name="custom_menu[active_group_id]" value="<?= $activeGroupId ?>">
		<input type="hidden" name="custom_menu[rows]">
		<div class="tbl-wrap pb">
			<table cellspacing="0" class="grid-input-form">
				<thead>
					<tr>
						<th class="first reorder-col"></th>
						<th>Menu Title</th>
						<th>Link</th>
						<th class="last grid-remove"></th>
					</tr>
				</thead>
				<tbody class="js-tbody js-sortable-container">
					<tr class="no-results js-no-results<?php if ($groupSettings) { ?> js-hide<?php } ?>">
						<td class="solo" colspan="4">
							<?= lang('no_menu_items') ?> <a class="btn action js-add-menu-item" href="#"><?= lang('add_menu_item') ?></a>
						</td>
					</tr>
					<tr class="js-sort-row js-hide js-blank-row">
						<td class="reorder-col js-sort-handle"><span class="ico reorder"></span></td>
						<td>
							<input type="text" class="js-menu-name">
						</td>
						<td>
							<input type="text" class="js-menu-url">
						</td>
						<td>
							<ul class="toolbar">
								<li class="remove js-remove-menu-item"><a href="#" title="remove row"></a></li>
							</ul>
						</td>
					</tr>
					<?php foreach ($groupSettings as $key => $val) { ?>
						<tr class="js-sort-row js-row">
							<td class="reorder-col js-sort-handle"><span class="ico reorder"></span></td>
							<td>
								<input type="text" class="js-menu-name" name="custom_menu[rows][<?= $key ?>][name]" value="<?= $val['name'] ?>">
							</td>
							<td>
								<input type="text" class="js-menu-url" name="custom_menu[rows][<?= $key ?>][url]" value="<?= $val['url'] ?>">
							</td>
							<td>
								<ul class="toolbar">
									<li class="remove js-remove-menu-item"><a href="#" title="remove row"></a></li>
								</ul>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<ul class="toolbar" style="">
			<li class="add js-add-menu-item"><a href="#" title="add new row"></a></li>
		</ul>
		<fieldset class="form-ctrls">
			<input type="submit" value="Update" class="btn" data-submit-text="Update" data-work-text="Updating">
		</fieldset>
	</form>
</div>
