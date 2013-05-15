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
		$this->renderPartial('_secWrapper', array(
			'goodsActive' => $goodsActive,
			'vehicles' => $vehicles,
			'vid' => isset($filter->good->id) ? $filter->good->id : null,
			'filter' => $filter,
			))
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
		<?php if ($this->user->goods): ?>
		<div class="widget fluid" style="margin-top: 10px;">
			<div class="formRow">
				<?php /* ?>
				<div class="grid2">
					<label>Обновлять каждые</label>
				</div>
				<div class="grid2">
					<?php
						echo CHtml::activeDropDownList($settings, 'autoupdate', Yii::app()->params['timer'],
								array('id' => 'autoupdate'),
								array());
					?>
				</div>
				<div class="grid2">
					<a id="timerButton" data-timer="<?php echo $settings->timer; ?>" href="javascript:void(0)" class="buttonS bDefault mb10 mt5">Старт</a>
				</div>
				<div class="grid3">
					<div id="progress1"><span class="pbar"></span><span class="percent"></span><span class="elapsed"></span></div>
				</div>
				<?php */ ?>
				<div class="grid12" style="text-align: left;">
					<a id="advancedFilterDialog_open" href="javascript:void(0)" class="buttonS bBrown tipS" 
					   title="Дополнительные условия для поиска"
					   original-title="Дополнительные условия для поиска" >
						Дополнительные настройки поиска
					</a>
					<?php $this->renderPartial('/blocks/popups/_advancedVehicleFilter', array(
						'model' => $model,
						'filter' => $filter, 
						'vid' => $vid,
						'countries' => $countries,
						'regions' => $regions,
						'cities' => $cities,
						)); 
					?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php endif; ?>
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
						<h6>Все доступные транспортные средства (<?php echo $pageSettings['count'] ?>)</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td width="10%">Фото</td>
								<td width="20%"><div>Название</div></td>
								<td width="20%"><div>Расположение</div></td>
								<td width="25%"><div>Характеристики</div></td>
								<td width="25%">Контакты</td>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="6">
									<?php if ($pageSettings['pages'] > 1): ?>
									<div class="tPages">
										<ul class="pages">
											<?php if ($pageSettings['page'] > 1): ?>
												<li><a href="/goods/search<?php echo $filter->getUrl('', 1); ?>" title="На первую страницу"><span><<</span></a></li>
												<li class="prev"><a href="/goods/search<?php echo $filter->getVehiclesUrl('', $pageSettings['page'] - 1); ?>" title="Предыдущая"><span class="icon-arrow-14"></span></a></li>
											<?php endif; ?>
											<?php 
												$startPage = ($pageSettings['page'] - (int) Yii::app()->params['pages']['pageNumbers'] < 0) ? 1 : ($pageSettings['page'] - (int) Yii::app()->params['pages']['pageNumbers'] + 2); 
												$endPage = $startPage + (int) Yii::app()->params['pages']['pageNumbers'] < $pageSettings['pages'] ? $startPage + (int) Yii::app()->params['pages']['pageNumbers'] : $pageSettings['pages']; 
											?>
											<?php for ($pageNumber = $startPage; $pageNumber < $endPage; $pageNumber++): ?>
												<li>
													<a href="/goods/search<?php echo $filter->getVehiclesUrl('', $pageNumber); ?>" <?php if ($pageNumber == $pageSettings['page']): ?>class="active"<?php endif; ?>>
														<?php echo $pageNumber; ?>
													</a>
												</li>
											<?php endfor; ?>
											<?php if ($pageNumber < $pageSettings['pages']): ?>
												<li>...</li>
											<?php endif; ?>
											<li>
												<a href="/goods/search<?php echo $filter->getVehiclesUrl('', $pageSettings['pages']); ?>" <?php if ($pageSettings['page'] == $pageSettings['pages']): ?>class="active"<?php endif; ?>>
													<?php echo $pageSettings['pages'] ?>
												</a>
											</li>
											<?php if ($pageSettings['page'] < $pageSettings['pages']): ?>
												<li class="next"><a href="/goods/search<?php echo $filter->getVehiclesUrl('', $pageSettings['page'] + 1); ?>" title="Следующая"><span class="icon-arrow-17"></span></a></li>
												<li><a href="/goods/search<?php echo $filter->getVehiclesUrl('', $pageSettings['pages']); ?>" title="На последнюю страницу"><span>>></span></a></li>
											<?php endif; ?>
										</ul>
									</div>
									<?php endif; ?>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($vehicles as $vehicle): ?>
								<tr>
									<td>
										<?php /* href="/vehicle/view/<?php echo $vehicle->id ?>" title=""*/ ?>
										<a href="javascript:void(0)">
											<?php $image = isset($vehicle->photos[0])
												? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_small
												: '/images/nophoto.jpg' ?>
											<img src="<?php echo $image; ?>" alt="" />
										</a>
									</td>
									<td class="fileInfo">
										<?php /* href="/vehicle/view/<?php echo $vehicle->id ?>" title=""*/ ?>
										<a href="javascript:void(0)">
											<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . " " . $vehicle->modeli->name ?>,
																				<br/>номер: <?php echo $vehicle->license_plate ?>
										</a><br/>
										<strong>Добавлен:</strong><br/>
										<span>
											<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->updated_at); ?>&nbsp;
											<?php echo date('H:i', $vehicle->updated_at); ?>
										</span>
									</td>
									<td class="fileInfo">
										<?php if ($vehicle->city_id): ?>
										<span>
											<?php echo $vehicle->countries->name_ru . ' - ' . (!empty($vehicle->countriesTo->name_ru) ? $vehicle->countriesTo->name_ru : 'Любая'); ?>
										</span>
										<span>
											<?php echo $vehicle->regions->name_ru . ' - ' . (!empty($vehicle->regionsTo->name_ru) ? $vehicle->regionsTo->name_ru : 'Любая'); ?>
										</span>
										<span>
											<?php echo $vehicle->cities->name_ru . ' - ' . (!empty($vehicle->citiesTo->name_ru) ? $vehicle->citiesTo->name_ru : 'Любой'); ?>
										</span>
										<span>
											<?php if ($vehicle->date_from && $vehicle->date_to): ?>
												c <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_from); ?> по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->date_to); ?>
											<?php endif; ?>
										</span>
										<?php endif; ?>
									</td>
									<td class="fileInfo">
										<span><strong>Тип кузова: </strong>
											<?php echo $vehicle->bodyType->name_ru ?>
										</span>
										<span><strong>Вид загрузки: </strong>
											<?php echo $vehicle->shipmentsNames ?>
										</span>
										<span><strong>Грузоподъемность: </strong>
											<?php echo $vehicle->bearing_capacity ?> т.
										</span>
										<span><strong>Объем кузова: </strong>
											<?php echo $vehicle->body_capacity ?> м&sup3;
										</span>
									</td>
									<td class="fileInfo">
										<?php /* href="/user/view/<?php echo $vehicle->user->id ?>" class="tipS" title="Перейти на страницу пользователя"*/ ?>
										<a href="javascript:void(0)">
											<strong><?php echo $vehicle->user->profiles->userType->name_ru ?></strong><br/>
											<?php echo $vehicle->user->organizations->formOrganizations->name_ru . ' ' . $vehicle->user->organizations->name_org ?><br/>
											<?php echo $vehicle->user->profiles->last_name . ' ' . $vehicle->user->profiles->first_name . ' ' . $vehicle->user->profiles->middle_name ?>
										</a><br/>
										м. <?php echo $vehicle->user->profiles->mobile ?>
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