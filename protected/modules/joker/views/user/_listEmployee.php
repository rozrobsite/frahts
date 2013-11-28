<div class="fluid">
	<?php foreach ($this->jokerUser->organizations->employees as $employee): ?>
	<div class="widget grid4">
		<div class="whead"><h6>Сотрудник</h6><a href="javascript:void(0);" class="buttonH bBlue jokerEmployee" data-id="" title="">Удалить</a><div class="clear"></div></div>
		<ul class="niceList params">
			<li class="">
				<label></span>ФИО:</label>
				    <?php
						$this->widget('editable.EditableField', array(
							'type' => 'text',
							'model' => $employee,
							'attribute' => 'fio',
							'url' => $this->createUrl('/joker/user/updateEmployee'),
							'placement' => 'right',
						));
					?>
				<div class="clear"></div>
			</li>
		</ul>
	</div>
	<?php endforeach; ?>
</div>
