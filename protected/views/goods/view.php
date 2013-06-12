<script type="text/javascript">
	var myMap, route;

	// Как только будет загружен API и готов DOM, выполняем инициализацию
	ymaps.ready(init);

	function init () {
		myMap = new ymaps.Map("map", {
				center: [<?php echo $model->cityFrom->latitude ?>, <?php echo $model->cityFrom->longitude ?>],
				zoom: 12
			});

		myMap.controls
			// Кнопка изменения масштаба — компактный вариант
			.add('zoomControl')
			// Список типов карты
			.add('typeSelector')
			.add('mapTools')
			.add('routeEditor')
			.add('trafficControl');

		var start = [<?php echo $model->cityFrom->latitude ?>, <?php echo $model->cityFrom->longitude ?>];
		var end = [<?php echo $model->cityTo->latitude ?>, <?php echo $model->cityTo->longitude ?>];
		ymaps.route([
			   // Список точек, которые необходимо посетить
			   [start], [end]], {
			// Опции маршрутизатора
			mapStateAutoApply: true // автоматически позиционировать карту
		}).then(function (router) {
			route && myMap.geoObjects.remove(route);
			route = router;
			route.options.set({ strokeColor: '0000ffff', opacity: 0.9 });
			myMap.geoObjects.add(route);

			$('#total_length_route').html(route.getHumanLength());
			$('#total_time_route').html(route.getHumanTime());
			// С помощью метода getWayPoints() получаем массив точек маршрута
				// (массив транзитных точек маршрута можно получить с помощью метода getViaPoints)
				var points = route.getWayPoints();
				// Задаем стиль метки - иконки будут красного цвета, и
				// их изображения будут растягиваться под контент
				points.options.set('preset', 'twirl#blueStretchyIcon');
				// Задаем контент меток в начальной и конечной точках
				var pointBegin = points.get(0);
				var pointEnd = points.get(1);

				pointBegin.properties.set('balloonContentBody', 'Точка отправления: <?php echo $model->cityFrom->name_ru ?>, <?php echo $model->regionFrom->name_ru ?>, <?php echo $model->countryFrom->name_ru ?>');
				pointEnd.properties.set('balloonContentBody', 'Точка прибытия: <?php echo $model->cityTo->name_ru ?>, <?php echo $model->regionTo->name_ru ?>, <?php echo $model->countryTo->name_ru ?>');

//				pointBegin.options.set('draggable', true);
//				pointEnd.options.set('draggable', true);
		}, function (error) {
			alert("Возникла ошибка: " + error.message);
		});

		return false;
	 }
</script>

<?php
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');

$this->pageTitle = Yii::app()->name . ' - Данные о грузе "' . $model->name . '"';
$this->breadcrumbs = array(
	'Данные о грузе',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapperDetail', array());
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
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск грузов</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о грузе "' . $model->name . '"'; ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
		<div class="widget">
            <div class="invoice">
                <div class="inHead">
                    <!--<span class="inLogo"><a href="index.html" title="invoice"><img src="images/newLogo.png" alt="logo" /></a></span>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo $model->name ?></span>
                        <i>Добавлено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $model->updated_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о грузе</h5>
                        <span><strong>Дата доставки:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
							по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_to); ?></span>
                        <span><strong>Откуда:</strong> <?php echo $model->cityFrom->name_ru ?>, <?php echo $model->regionFrom->name_ru ?>, <?php echo $model->countryFrom->name_ru ?></span>
                        <span><strong>Куда:</strong> <?php echo $model->cityTo->name_ru ?>, <?php echo $model->regionTo->name_ru ?>, <?php echo $model->countryTo->name_ru ?></span>
                        <span><strong>Подходящие типы транспорта:</strong> <?php echo $vehicleTypes; ?></span>
                        <span><strong>Подходящие типы кузовов:</strong> <?php echo $bodyTypes; ?></span>
                        <?php if (!empty($shipments)): ?>
							<span><strong>Подходящие виды загрузки:</strong> <?php echo $shipments; ?></span>
						<?php endif; ?>
                        <span>
							<strong>Вес груза: </strong>
							<?php if ($model->weight_from): ?>
								от <?php echo $model->weight_from; ?> т.
								до <?php echo $model->weight_to; ?> т.
							<?php else: ?>
								<?php echo $model->weight_exact_value; ?> т.
							<?php endif; ?>
						</span>
                        <span>
							<strong>Объем груза: </strong>
							<?php if ($model->capacity_from): ?>
								от <?php echo $model->capacity_from; ?> м&sup3;
								до <?php echo $model->capacity_to; ?> м&sup3;
							<?php else: ?>
								<?php echo $model->capacity_exact_value; ?> м&sup3;
							<?php endif; ?>
						</span>
						<?php if (!empty($permissions)): ?>
							<span><strong>Требуемые разрешения:</strong> <?php echo $permissions; ?></span>
						<?php endif; ?>
						<span><strong>Оплата:</strong> <?php echo $model->cost . ' ' . $model->currency->name_ru . ' (' . $model->paymentType->name_ru . ')'; ?></span>
                    </div>
					<div class="floatR" style="width:55%;height:430px; margin:10px;">
						<div id="map" style="width:100%;height:430px;"></div>
						<div style="float:left;">
							<label><strong>Общая длина маршрута: </strong><span id="total_length_route"></span></label>
						</div>
						<div style="float:right;">
							<label><strong>Срелнее время в пути: </strong><span id="total_time_route"></span></label>
						</div>
					</div>
                    <div class="inFrom" style="width:30%">
						<h5>Владелец груза</h5>
						<span>
							<?php echo $model->user->profiles->last_name . ' ' . $model->user->profiles->first_name . ' ' . $model->user->profiles->middle_name; ?>
						</span>
						<span><?php echo $model->user->profiles->userType->name_ru; ?></span>
						<span><?php echo $model->user->organizations->name_org; ?></span>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->user->profiles->mobile ?></strong></span>
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?></span>
                    </div>
                    <div class="inFrom" style="width:100%">
						<h5>Дополнительное описание</h5>
						<p>
							<?php echo $model->description; ?>
						</p>
                    </div>
                    <div class="clear"></div>
                </div>
				<?php /* ?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
					<tr>
						<td>
							<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
						</td>
						<td>
							<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
						</td>
						<td>
							<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
						</td>
						<td>
							<a href="/vehicle/search" title="Поиск всех доступных грузов" class="sideB bSea tipS">Показать все грузы</a>
						</td>
					</tr>
				</table>
				<?php */ ?>
				<?php if ($model->user->goods && count($model->user->goods) > 1): ?>
					<div class="inFrom" style="width:100%">
						<h5>Еще доступные грузы этого пользователя</h5>
					</div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
						<thead>
							<tr>
								<td width="40%">Маршрут</td>
								<td width="15%">Дата доставки</td>
								<td width="25%">Груз</td>
								<td width="20%">Дата добавления</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach($model->user->goods as $oneGood): ?>
								<?php if (!$oneGood->is_deleted && $oneGood->date_to >= time() && $oneGood->id != $model->id): ?>
									<tr>
										<td>
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
												<strong>&asymp;&nbsp;<?php echo ((int) FHelper::distance($oneGood->cityFrom->latitude, $oneGood->cityFrom->longitude, $oneGood->cityTo->latitude, $oneGood->cityTo->longitude) + 10) ?> км</strong>
											</span>
										</td>
										<td>
											с
											<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_from); ?><br/>
											по
											<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $oneGood->date_to); ?>
										</td>
										<td>
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
										<td>
											<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?><br/>
											<?php echo Yii::app()->dateFormatter->format('HH:mm', ($oneGood->updated_at ? $oneGood->updated_at : $oneGood->created_at)); ?>
										</td>
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
            </div>
        </div>
	</div>
</div>
<!-- Content ends -->
