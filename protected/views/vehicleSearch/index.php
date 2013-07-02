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
//			'vehicles' => $vehicles,
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
					Дополнительные настройки поиска
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
		<?php if (!$goods): ?>
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
									<?php if ($pageSettings['pages'] > 1): ?>
									<div class="tPages">
										<ul class="pages">
											<?php if ($pageSettings['page'] > 1): ?>
												<li><a href="/vehicle/search<?php echo $filter->getUrl('', 1); ?>" title="На первую страницу"><span><<</span></a></li>
												<li class="prev"><a href="/vehicle/search<?php echo $filter->getUrl('', $pageSettings['page'] - 1); ?>" title="Предыдущая"><span class="icon-arrow-14"></span></a></li>
											<?php endif; ?>
											<?php
												$startPage = ($pageSettings['page'] - (int) Yii::app()->params['pages']['pageNumbers'] < 0) ? 1 : ($pageSettings['page'] - (int) Yii::app()->params['pages']['pageNumbers'] + 2);
												$endPage = $startPage + (int) Yii::app()->params['pages']['pageNumbers'] < $pageSettings['pages'] ? ($startPage + (int) Yii::app()->params['pages']['pageNumbers']) : $pageSettings['pages'];
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
									<?php endif; ?>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($goods as $oneGood): ?>
							<tr>
								<td style="font-size: 11px;">
									<span>
										<?php echo $oneGood->countryFrom->name_ru . ' - ' .  $oneGood->countryTo->name_ru?>
									</span><br/>
									<span>
										<?php echo $oneGood->regionFrom->name_ru . ' - ' .  $oneGood->regionTo->name_ru?>
									</span><br/>
									<span>
										<?php echo $oneGood->cityFrom->name_ru . ' - ' .  $oneGood->cityTo->name_ru?>
									</span>
									<br/>
									<span>
										<?php $distance = ((int) FHelper::distance($oneGood->cityFrom->latitude, $oneGood->cityFrom->longitude, $oneGood->cityTo->latitude, $oneGood->cityTo->longitude) + 10); ?>
										<strong><a href="/goods/view/<?php echo $oneGood->slug ?>">&asymp;&nbsp;<?php echo $distance ?> км</a></strong>
									</span>
								</td>
								<td class="fileInfo">
									с
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_from); ?><br/>
									по
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_to); ?>
								</td>
								<td class="fileInfo">
									<a href="/goods/view/<?php echo $oneGood->slug ?>" class="tipS" title="Перейти на страницу груза">
										<?php echo $oneGood->name ?><br/>
										<?php
										$weight = 0;
										if (isset($oneGood->weight_exact_value) && $oneGood->weight_exact_value)
										{
											$weight = $oneGood->weight_exact_value;
										}
										elseif (isset($oneGood->weight_to) && $oneGood->weight_to)
										{
											$weight = $oneGood->weight_to;
										}
										?>
										Вес до: <?php echo $weight ?> т.<br/>
										<?php
										$capacity = 0;
										if (isset($oneGood->capacity_exact_value) && $oneGood->capacity_exact_value)
										{
											$capacity = $oneGood->capacity_exact_value;
										}
										elseif (isset($oneGood->capacity_to) && $oneGood->capacity_to)
										{
											$capacity = $oneGood->capacity_to;
										}
										?>
										Объем до: <?php echo $capacity ?> м&sup3;<br/>
									</a>
								</td>
								<td class="fileInfo">
									<span><strong>Тип кузова: </strong>
										<?php echo $oneGood->bodyTypeNames ?>
									</span>
									<span><strong>Вид загрузки: </strong>
										<?php echo $oneGood->shipmentsNames ?>
									</span>
								</td>
								<td class="fileInfo">
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?><br/>
									<?php echo Yii::app()->dateFormatter->format('HH:mm', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?>
								</td>
								<td class="fileInfo">
									<strong>
										<?php echo $oneGood->paymentType->name_ru ?><br/>
										<?php echo $oneGood->cost . ' ' . $oneGood->currency->name_ru ?>
									</strong><br/>
									<?php if ($oneGood->user->profiles->userType->id == UserTypes::DISPATCHER): ?>
										(Комиссия: <?php echo $oneGood->fee ?>)
									<?php endif; ?>
								</td>
								<td class="fileInfo">
									<a href="/user/view/<?php echo $oneGood->user->username ?>" class="tipS" title="Перейти на страницу пользователя">
										<strong><?php echo $oneGood->user->profiles->userType->name_ru ?></strong><br/>
										<?php echo $oneGood->user->organizations->formOrganizations->name_ru . ' ' . $oneGood->user->organizations->name_org ?><br/>
										<?php echo $oneGood->user->profiles->last_name . ' ' . $oneGood->user->profiles->first_name . ' ' . $oneGood->user->profiles->middle_name ?>
									</a><br/>
									м. <?php echo $oneGood->user->profiles->mobile ?>
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