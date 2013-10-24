<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Мой транспорт';
$this->breadcrumbs = array(
	'current' => 'Мой транспорт',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('is_active' => 1))
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

	<!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="fluid">
				<div class="widget">
					<div class="whead"><h6>Мои транспорт</h6><div class="clear"></div></div>
					<div id="dyn" class="hiddenpars">
						<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
						<thead>
							<tr>
								<th style="background: #EEE;">Фото</th>
								<th style="background: #EEE;">Название</th>
								<th style="background: #EEE;">Срок загрузки</th>
								<th style="background: #EEE;">Дата добавления</th>
								<th style="background: #EEE;">Действия</th>
							</tr>
						</thead>
						<tbody style="text-align: center;">
							<?php foreach ($activeVehicles as $vehicle): ?>
								<?php if ($vehicle->is_deleted) continue; ?>
								<tr>
									<td>
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
											<?php $image = isset($vehicle->photos[0]) ? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_small : '/images/nophoto.jpg' ?>
											<img src="<?php echo $image; ?>" alt="" />
										</a>
									</td>
									<td>
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
											<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . (isset($vehicle->modeli->name) ? ' ' . $vehicle->modeli->name : '') ?>,
											номер: <?php echo $vehicle->license_plate ?>
										</a>
									</td>
									<td class="center">
										<span style="<?php if ($vehicle->date_to < time()): ?>color:red<?php endif; ?>">
											c <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_from); ?> по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_to); ?><br/>
											<?php if ($vehicle->date_to < time()): ?><span style="color:red; font-size: 11px;">(Просрочено, обязательно обновите данные)</span><?php endif; ?>
										</span>
									</td>
									<td class="center"><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $vehicle->created_at); ?></td>
									<td>
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать"><span class="iconb" data-icon="&#xe1db;"></span></a>
										<a href="javascript:void(0)" class="tablectrl_small bGold tipS vehicleDeleteSearch" title="Удалить транспортное средство" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>


	</div>
</div>