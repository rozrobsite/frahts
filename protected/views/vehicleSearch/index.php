<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Поиск подходящего груза';
$this->breadcrumbs = array(
	'Поиск подходящего груза',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'vehicleActive' => $vehicleActive, 
			'vehicles' => $vehicles, 
			'vid' => isset($filter->vehicle->id) ? $filter->vehicle->id : null,
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
                <li><a href="/vehicle/search">Поиск груза</a></li>
                <li class="current">
					<a title="">Найденные подходящие грузы</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php if (!$this->user->vehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					У Вас нет добавленных транспортных средств. Добавьте транспортное средство чтобы найти подходящий груз.
				</label>
				<div class="formRow" style="border-top: 0">
					<div class="grid5">&nbsp;</div>
					<div class="grid2">
						<a id="vehicles_modal_open" href="/vehicle/new" title="" class="sideB bGreen goods_modal_open">Добавить транспорт</a>
					</div>
					<div class="grid5">&nbsp;</div>
				</div>
			</div>
		<?php else: ?>
		<?php if ($this->user->vehicles): ?>
		<div class="widget fluid" style="margin-top: 10px;">
			<div class="formRow">
				<a id="advancedFilterDialog_open" href="javascript:void(0)" class="buttonS bBrown tipS" 
				   title="Дополнительные условия для поиска"
				   original-title="Дополнительные условия для поиска" >
					Расширенный фильтр
				</a>
				<?php $this->renderPartial('/blocks/popups/_advancedFilter', array(
					'model' => $model,
					'filter' => $filter, 
					'vid' => $vid,
					'countries' => $countries,
					'regions' => $regions,
					'cities' => $cities,
					'filterCountries' => $countries,
					'filterRegions' => $filterRegions,
					'filterCities' => $filterCities,
					)); 
				?>
			</div>
		</div>
		<?php endif; ?>
		<?php if (!$vehicles): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					К сожалению для Вашего транспортного средства не найдено ни одного подходящего груза.
				</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget" style="margin-top: 10px;">
					<div class="whead">
						<h6>Все грузы (<?php echo $pageSettings['count'] ?>)</h6>
						<div class="clear"></div>
					</div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia" id="checkAll">
						<thead>
							<tr>
								<td width="20%"><div>Маршрут</div></td>
								<td width="10%"><div>Дата доставки</div></td>
								<td width="14%"><div>Груз</div></td>
								<td width="14%">Требуемый транспорт</td>
								<td width="13%" class="sortCol <?php if ($pageSettings['sort'] == SearchFilter::SORT_CREATED_AT): ?>header <?php echo ($pageSettings['direct'] == SearchFilter::DIRECTION_DESC ? "headerSortDown" : "headerSortUp") ?><?php endif;?>">
									<a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['page']); ?>&sort=<?php echo SearchFilter::SORT_CREATED_AT ?>&direct=<?php echo !$filter->direction ?>">Дата добавления<span></span></a>
								</td>
								<td width="10%" class="sortCol <?php if ($pageSettings['sort'] == SearchFilter::SORT_PAYMENT_TYPE): ?>header <?php echo ($pageSettings['direct'] == SearchFilter::DIRECTION_DESC ? "headerSortDown" : "headerSortUp") ?><?php endif;?>">
									<a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['page']); ?>&sort=<?php echo SearchFilter::SORT_PAYMENT_TYPE ?>&direct=<?php echo !$filter->direction ?>">Вид оплаты<span></span></a>
								</td>
								<td>Контакты</td>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="7">
									<div class="tPages">
										<ul class="pages">
											<?php if ($pageSettings['page'] > 1): ?>
												<li><a href="/vehicle/search<?php echo $filter->getUrl('', 1); ?>" title="На первую страницу"><span><<</span></a></li>
												<li class="prev"><a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['page'] - 1); ?>" title="Предыдущая"><span class="icon-arrow-14"></span></a></li>
											<?php endif; ?>
											<?php 
												$startPage = $pageSettings['page'] - (int) Yii::app()->params['pages']['pageNumbers'] < 1 ? 1 : $pageSettings['page']; 
												$endPage = $startPage + (int) Yii::app()->params['pages']['pageNumbers'] < $pageSettings['pages'] ? $startPage + (int) Yii::app()->params['pages']['pageNumbers'] : $pageSettings['pages']; 
											?>
											<?php for ($pageNumber = $startPage; $pageNumber < $endPage; $pageNumber++): ?>
												<li>
													<a href="/vehicle/search<?php echo $filter->getUrl('', $pageNumber); ?>" <?php if ($pageNumber == $pageSettings['page']): ?>class="active"<?php endif; ?>>
														<?php echo $pageNumber; ?>
													</a>
												</li>
											<?php endfor; ?>
											<?php if ($pageNumber < $pageSettings['pages']): ?>
												<li>...</li>
											<?php endif; ?>
											<li>
												<a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['pages']); ?>" <?php if ($pageSettings['page'] == $pageSettings['pages']): ?>class="active"<?php endif; ?>>
													<?php echo $pageSettings['pages'] ?>
												</a>
											</li>
											<?php if ($pageSettings['page'] < $pageSettings['pages']): ?>
												<li class="next"><a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['page'] + 1); ?>" title="Следующая"><span class="icon-arrow-17"></span></a></li>
												<li><a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['pages']); ?>" title="На последнюю страницу"><span>>></span></a></li>
											<?php endif; ?>
										</ul>
									</div>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($vehicles as $oneVehicle): ?>
							<tr>
								<td style="font-size: 11px;">
									<span>
										<?php echo $oneVehicle->countryFrom->name_ru . ' - ' .  $oneVehicle->countryTo->name_ru?>
									</span><br/>
									<span>
										<?php echo $oneVehicle->regionFrom->name_ru . ' - ' .  $oneVehicle->regionTo->name_ru?>
									</span><br/>
									<span>
										<?php echo $oneVehicle->cityFrom->name_ru . ' - ' .  $oneVehicle->cityTo->name_ru?>
									</span>
								</td>
								<td class="fileInfo">
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneVehicle->date_to); ?>
								</td>
								<td class="fileInfo">
									<a href="/goods/view/<?php echo $oneVehicle->id ?>" class="tipS" title="Перейти на страницу груза">
										<?php echo $oneVehicle->name ?><br/>
										Вес до: <?php echo $oneVehicle->weight_to ?> т.<br/>
										Объем до: <?php echo $oneVehicle->capacity_to ?> м&sup3;<br/>
									</a>
								</td>
								<td class="fileInfo">
									<span><strong>Тип кузова: </strong>
										<?php echo $oneVehicle->bodyTypeNames ?>
									</span>
									<span><strong>Вид загрузки: </strong>
										<?php echo $oneVehicle->shipmentsNames ?>
									</span>
								</td>
								<td class="fileInfo">
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', ($oneVehicle->updated_at ? $oneVehicle->updated_at : $oneVehicle->created_at)); ?><br/>
									<?php echo Yii::app()->dateFormatter->format('HH:mm', ($oneVehicle->updated_at ? $oneVehicle->updated_at : $oneVehicle->created_at)); ?>
								</td>
								<td class="fileInfo">
									<strong>
										<?php echo $oneVehicle->paymentType->name_ru ?><br/>
										<?php echo $oneVehicle->cost . ' ' . $oneVehicle->currency->name_ru ?>
									</strong><br/>
									<?php if ($oneVehicle->user->profiles->userType->id == UserTypes::DISPATCHER): ?>
										(Комиссия: <?php echo $oneVehicle->fee ?>)
									<?php endif; ?>
								</td>
								<td class="fileInfo">
									<a href="/user/view/<?php echo $oneVehicle->user->id ?>" class="tipS" title="Перейти на страницу пользователя">
										<?php echo $oneVehicle->user->organizations->name_org ?><br/>
										<?php echo $oneVehicle->user->profiles->last_name . ' ' . $oneVehicle->user->profiles->first_name . ' ' . $oneVehicle->user->profiles->middle_name ?>
									</a><br/>
									м. <?php echo $oneVehicle->user->profiles->mobile ?>
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