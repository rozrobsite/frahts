<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Мой транспорт';
$this->breadcrumbs = array(
	'Мой транспорт',
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
	<!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/vehicle">Мой транспорт</a></li>
                <li class="current"><a title="">Учавствующий в поиске</a></li>
            </ul>
        </div>
    </div>
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
						<span class="titleIcon">
							<input type="checkbox" id="titleCheck" name="titleCheck" />
						</span>
						<h6>Транспортные средства учавствующие в поиске</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td width="5%"><img src="/images/elements/other/tableArrows.png" alt="" /></td>
								<td width="10%">Фото</td>
								<td width="35%">
									Название
								</td>
								<td width="20%">Тип транспорта</td>
								<td width="15%">
									Дата регистрации
								</td>
								<td width="15%">Действие</td>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="6">
									<div class="itemActions">
										<label>Выполнить:</label>
										<select id="vehicleDeleteSearchAction">
											<option value="0">Выберите действие...</option>
											<option value="1">Удалить из поиска</option>
										</select>
									</div>
	<!--								<div class="tPages">
										<ul class="pages">
											<li class="prev"><a href="#" title=""><span class="icon-arrow-14"></span></a></li>
											<li><a href="#" title="" class="active">1</a></li>
											<li><a href="#" title="">2</a></li>
											<li><a href="#" title="">3</a></li>
											<li><a href="#" title="">4</a></li>
											<li><a href="#" title="">5</a></li>
											<li><a href="#" title="">6</a></li>
											<li>...</li>
											<li><a href="#" title="">20</a></li>
											<li class="next"><a href="#" title=""><span class="icon-arrow-17"></span></a></li>
										</ul>
									</div>-->
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($activeVehicles as $vehicle): ?>
								<tr>
									<td><input data-id="<?php echo $vehicle->id ?>" type="checkbox" name="checkRow" class="vehicleChecked" /></td>
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
										<span>
											<strong><?php echo $vehicle->vehicleType->name_ru ?></strong>
										</span>
									</td>
									<td><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $vehicle->created_at); ?></td>
									<td class="tableActs">

										<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать"><span class="iconb" data-icon="&#xe1db;"></span></a>

<!--										<a href="javascript:void(0)" class="tablectrl_small bGold tipS vehicleDeleteSearch" title="Удалить из поиска" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe212;"></span></a>-->
										<a href="javascript:void(0)" class="tablectrl_small bGold tipS vehicleDeleteSearch" title="Удалить из поиска" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
										<!--<a href="javascript:void(0)" class="tablectrl_small bRed tipS vehicleDeleteBase" title="Удалить из базы" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>-->
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