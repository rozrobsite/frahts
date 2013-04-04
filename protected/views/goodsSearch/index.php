<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Поиск подходящего транпорта';
$this->breadcrumbs = array(
	'Поиск подходящего транпорта',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('goodsActive' => $goodsActive, 'vehicles' => $vehicles))
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
                <li><a href="/goods/search">Поиск транспорта</a></li>
                <li class="current">
					<a title="">Найденные подходящие транпортные средства</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php if (!$this->user->goods): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					У Вас нет добавленных грузов. Добавьте груз чтобы найти подходящее транспортное средство.
				</label>
				<div class="formRow" style="border-top: 0">
					<div class="grid5">&nbsp;</div>
					<div class="grid2">
						<a id="goods_modal_open" href="/goods/new" title="" class="sideB bGreen goods_modal_open">Добавить</a>
					</div>
					<div class="grid5">&nbsp;</div>
				</div>
			</div>
		<?php else: ?>
		<?php if (!$vehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					К сожалению для Ваших грузов не найдено ни одного транспортного средства.
				</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget check">
					<div class="whead">
						<span class="titleIcon">
							<input type="checkbox" id="titleCheck" name="titleCheck" />
						</span>
						<h6>Найденные подходящие транспортные средства для Ваших грузов (1200 шт.)</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td><img src="/images/elements/other/tableArrows.png" alt="" /></td>
								<td width="50">Фото</td>
								<td>
									<!--<div>-->
									Название
									<!--<span></span>-->
									<!--</div>-->
								</td>
								<td width="150">Тип транспорта</td>
								<td width="140">
									<!--<div>-->
									Дата регистрации
									<!--<span></span>-->
									<!--</div>-->
								</td>
								<td width="100">Действие</td>
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
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($vehicles as $vehicle): ?>
								<tr>
									<td><input data-id="<?php echo $vehicle->id ?>" type="checkbox" name="checkRow" class="vehicleChecked" /></td>
									<td>
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
								<?php $image = isset($vehicle->photos[0])
											? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_small
											: '/images/nophoto.jpg' ?>
											<img src="<?php echo $image; ?>" alt="" />
										</a>
									</td>
									<td class="textL">
										<a href="/vehicle/update/<?php echo $vehicle->id ?>" title="">
											<?php echo ucfirst($vehicle->bodyType->name_ru) . " " . $vehicle->make->name . " " . $vehicle->model->name ?>, 
																				номер: <?php echo $vehicle->license_plate ?>
										</a>
									</td>
									<td class="fileInfo">
										<span>
											<strong><?php echo $vehicle->vehicleType->name_ru ?></strong>
										</span>
									</td>
									<td><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy',
											$vehicle->created_at); ?>
									</td>
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
		<?php endif; ?>
	</div>
	<!-- Content ends -->
<?php $this->renderPartial('/blocks/_notify') ?>