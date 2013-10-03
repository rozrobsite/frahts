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

		<?php if (!$activeVehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">У Вас нет транспортных средств учавствующих в поиске.</label>
				<div class="formRow" style="border-top: 0">
					<div class="grid5">&nbsp;</div>
					<div class="grid2">
						<a href="/vehicle/new" title="" class="sideB bGreen">Добавить</a>
					</div>
					<div class="grid5">&nbsp;</div>
				</div>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget check">
					<div class="whead">
						<h6>Ваши транспортные средства</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td width="5%">Фото</td>
								<td width="35%">
									Название
								</td>
								<td width="20%">Срок загрузки</td>
								<td width="15%">
									Дата регистрации
								</td>
								<td width="15%">Действие</td>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="6"></td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($activeVehicles as $vehicle): ?>
								<tr>
									<td>
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
											<?php $image = isset ($vehicle->photos[0]) ? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_small : '/images/nophoto.jpg'?>
											<img src="<?php echo $image; ?>" alt="" />
										</a>
									</td>
									<td class="textL">
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
											<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . (isset($vehicle->modeli->name) ?  ' ' . $vehicle->modeli->name : '')?>,
											номер: <?php echo $vehicle->license_plate ?>
										</a>
									</td>
									<td class="fileInfo">
										<span style="<?php if ($vehicle->date_to < time()): ?>color:red<?php endif; ?>">
											c <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_from); ?> по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_to); ?>
											<?php if ($vehicle->date_to < time()): ?><span style="color:red">(Просрочено, обязательно обновите данные)</span><?php endif; ?>
										</span>
									</td>
									<td><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $vehicle->created_at); ?></td>
									<td class="tableActs">
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать"><span class="iconb" data-icon="&#xe1db;"></span></a>
										<a href="javascript:void(0)" class="tablectrl_small bGold tipS vehicleDeleteSearch" title="Не показывать в поиске" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>