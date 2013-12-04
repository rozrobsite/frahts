<div id="vendibles" class="fluid">
	<div class="widget">
		<div class="whead">
			<h6>Товары для продажи</h6>
			<div class="clear"></div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" class="tAlt wGeneral">
			<thead>
				<tr>
					<td width="5%">№</td>
					<td width="25%">Наименование</td>
					<td width="40%">Краткое описание</td>
					<td width="20%">Цена</td>
                    <td width="10%">Действие</td>
				</tr>
			</thead>
			<tbody>
                <?php if ($this->jokerUser->organizations->vendibles): ?>
				<?php foreach ($this->jokerUser->organizations->vendibles as $vendible): ?>
					<tr class="vendible_<?php echo $vendible->id; ?>">
						<td align="center">
							<?php echo $vendible->id; ?>
						</td>
						<td>
							<input id="vendible__name_<?php echo $vendible->id; ?>" type="text" class="jokerVendible" value="<?php echo $vendible->name; ?>" />
							<div id="error_vendible__name_<?php echo $vendible->id; ?>" class="error"></div>
						</td>
						<td>
							<input id="vendible__description_<?php echo $vendible->id; ?>" type="text" class="jokerVendible" value="<?php echo $vendible->description; ?>" />
							<div id="error_vendible_description_<?php echo $vendible->id; ?>" class="error"></div>
						</td>
						<td align="center">
							<input id="vendible_cost_<?php echo $vendible->id; ?>" type="text" class="jokerVendible" value="<?php echo $vendible->cost; ?>" />
							<div id="error_vendible_cost_<?php echo $vendible->id; ?>" class="error"></div>
						</td>
						<td align="center">
							<a href="javascript:void(0);" class="tablectrl_small bDefault tipS jokerVendibleUpdate" title="Сохранить изменения" data-id="<?php echo $vendible->id; ?>"><span class="iconb" data-icon="&#xe134;"></span></a>
							<a href="javascript:void(0);" class="tablectrl_small bDefault tipS jokerVendibleDelete" title="Удалить" data-id="<?php echo $vendible->id; ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
						</td>
					</tr>
				<?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">
                            <strong style="color: #5F5F5F;">Не добавлено ни одного товара</strong>
                        </td>
                    </tr>
                <?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
