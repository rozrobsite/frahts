<div id="employees" class="fluid">
	<div class="widget">
		<div class="whead">
			<h6>Сотрудники</h6>
			<div class="clear"></div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" class="tAlt wGeneral">
			<thead>
				<tr>
					<td width="4%">№</td>
					<td width="28%">ФИО</td>
					<td width="28%">Должность</td>
					<td width="15%">Телефон мобильный</td>
					<td width="15%">Элеткронный адрес (E-mail)</td>
					<td width="10%">Действие</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->jokerUser->organizations->employees as $employee): ?>
					<tr>
						<td align="center">
							<?php echo $employee->id; ?>
						</td>
						<td>
							<input id="employee_fio_<?php echo $employee->id; ?>" type="text" class="jokerEmployee" value="<?php echo $employee->fio; ?>" />
							<div id="error_employee_fio_<?php echo $employee->id; ?>" class="error"></div>
						</td>
						<td>
							<input id="employee_position_<?php echo $employee->id; ?>" type="text" class="jokerEmployee" value="<?php echo $employee->position; ?>" />
							<div id="error_employee_position_<?php echo $employee->id; ?>" class="error"></div>
						</td>
						<td align="center">
							<input id="employee_mobile_<?php echo $employee->id; ?>" type="text" class="jokerEmployee" value="<?php echo $employee->mobile; ?>" />
							<div id="error_employee_mobile_<?php echo $employee->id; ?>" class="error"></div>
						</td>
						<td align="center">
							<input id="employee_email_<?php echo $employee->id; ?>" type="text" class="jokerEmployee" value="<?php echo $employee->email; ?>" />
							<div id="error_employee_email_<?php echo $employee->id; ?>" class="error"></div>
						</td>
						<td align="center">
							<a href="javascript:void(0);" class="tablectrl_small bDefault tipS jokerEmployeeUpdate" title="Сохранить изменения" data-id="<?php echo $employee->id; ?>"><span class="iconb" data-icon="&#xe134;"></span></a>
							<a href="javascript:void(0);" class="tablectrl_small bDefault tipS jokerEmployeeDelete" title="Удалить"><span class="iconb" data-icon="&#xe136;"></span></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
