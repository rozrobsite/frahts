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
		$this->renderPartial('_secWrapper', array('is_active' => 2))
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
	
	<?php $this->renderPartial('_accessMessage') ?>
	
	<?php $this->renderPartial('/blocks/contentTop') ?>
	<!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/vehicle">Мой транспорт</a></li>
                <li class="current"><a title="">Удаленный из поиска</a></li>
            </ul>
        </div>
    </div>
	<!-- Main content -->
    <div class="wrapper">
		<?php if (!$noactiveVehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">У Вас нет транспортных средств удаленных из поиска.</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget check">
					<div class="whead">
						<span class="titleIcon">
							<input type="checkbox" id="titleCheck" name="titleCheck" />
						</span>
						<h6>Транспортные средства удаленные из поиска</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td><img src="/images/elements/other/tableArrows.png" alt="" /></td>
								<td width="50">Фото</td>
								<td class="sortCol">
									<!--<div>-->
										Название
										<!--<span></span>-->
									<!--</div>-->
								</td>
								<td width="150">Тип транспорта</td>
								<td width="140" class="sortCol">
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
										<select id="vehicleReturnSearchAction">
											<option value="0">Выберите действие...</option>
											<option value="1">Вернуть в поиск</option>
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
							<?php foreach ($noactiveVehicles as $vehicle): ?>
								<tr>
									<td><input data-id="<?php echo $vehicle->id ?>" type="checkbox" name="checkRow" class="vehicleChecked" /></td>
									<td>
										<?php $image = isset ($vehicle->photos[0]) ? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_small : '/images/nophoto.jpg'?>
										<img src="<?php echo $image; ?>" alt="" />
									</td>
									<td class="textL">
										<?php echo ucfirst($vehicle->bodyType->name_ru) . " " . $vehicle->make->name . (isset($vehicle->model->name) ? ' ' . $vehicle->model->name : '') ?>, 
										номер: <?php echo $vehicle->license_plate ?>
									</td>
									<td class="fileInfo">
										<span>
											<strong><?php echo $vehicle->vehicleType->name_ru ?></strong>
										</span>
									</td>
									<td><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $vehicle->created_at); ?></td>
									<td class="tableActs">
										<!--<a href="/vehicle/update/<?php echo $vehicle->id ?>" class="tablectrl_small bLightBlue tipS" title="Редактировать"><span class="iconb" data-icon="&#xe1db;"></span></a>-->
										<a href="javascript:void(0)" class="tablectrl_small bGreen tipS vehicleReturnSearch" title="Вернуть в поиск" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe213;"></span></a>
										<a href="javascript:void(0)" class="tablectrl_small bRed tipS vehicleDeleteBase" title="Удалить из базы" rel="<?php echo $vehicle->id ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
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