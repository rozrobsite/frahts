<style type="text/css">
div.ic_myCarousel {
	margin: 5px auto 0 auto;
	-moz-box-shadow: 0px 0px 10px #333;
	-webkit-box-shadow:  0px 0px 10px #333;
	box-shadow:  0px 0px 10px #333;
	clear:right;
	background: #eee;
}
.ic_myCarousel .ic_button {
	background: #999;
	width: 10px;
	height: 10px;
	position: relative;
	float: left;
	margin-right: 6px;
	border-radius: 10px;
	margin-top: 1px;
	border: 1px solid #eee;
}
.ic_myCarousel .ic_thumbnails {
	box-shadow: 0px 1px 4px #666;
	position: relative;
	overflow: auto;
	border-radius: 10px;
	padding: 2px 6px;
	height: 14px;
	margin: 0 auto;
	display: inline-block;
	background: rgb(238,238,238);
	background: -moz-linear-gradient(top, rgba(238,238,238,1) 0%, rgba(187,187,187,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(187,187,187,1)));
	background: -webkit-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(187,187,187,1) 100%);
	background: -o-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(187,187,187,1) 100%);
	background: -ms-linear-gradient(top, rgba(238,238,238,1) 0%,rgba(187,187,187,1) 100%);
	background: linear-gradient(top, rgba(238,238,238,1) 0%,rgba(187,187,187,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#bbbbbb',GradientType=0 );
}

/* keep this after the ic_button code for proper border coloring */
.ic_myCarousel2 .ic_active, .ic_myCarousel .ic_active, .ic_vidCarousel .ic_active  {
	background: #fff;
	border: 1px solid #faa;
}
.ic_caption {
	opacity: .6;
	background: #fff;
	font-size: 12px;
	font-family: arial;
	padding: 4px 8px;
	width: auto;
}
</style>
<script type="text/javascript">
	var myMap, route;

	// Как только будет загружен API и готов DOM, выполняем инициализацию
	ymaps.ready(init);

	function init () {
		myMap = new ymaps.Map("map", {
				center: [<?php echo $model->cities->latitude ?>, <?php echo $model->cities->longitude ?>],
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

		var start = [<?php echo $model->cities->latitude ?>, <?php echo $model->cities->longitude ?>];
		<?php if ($model->citiesTo->latitude): ?>
			var end = [<?php echo $model->citiesTo->latitude ?>, <?php echo $model->citiesTo->longitude ?>];
		<?php endif; ?>
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

				pointBegin.properties.set('balloonContentBody', 'Текущее положение: <?php echo $model->cities->name_ru ?>, <?php echo $model->regions->name_ru ?>, <?php echo $model->countries->name_ru ?>');
				pointEnd.properties.set('balloonContentBody', 'Готов ехать: <?php echo $model->citiesTo->name_ru ?>, <?php echo $model->regionsTo->name_ru ?>, <?php echo $model->countriesTo->name_ru ?>');

//				pointBegin.options.set('draggable', true);
//				pointEnd.options.set('draggable', true);
		}, function (error) {
			alert("Возникла ошибка: " + error.message);
		});

		return false;
	 }
</script>

<?php
Yii::app()->clientScript->registerScriptFile('/js/plugins/carousel/jquery.infinitecarousel3.min.js');
Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');

$this->pageTitle = Yii::app()->name . ' - Данные о транспортном средстве "' . ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name
								. ', номер: ' . $model->license_plate . '"';
$this->breadcrumbs = array(
	'Данные о транспортном средстве',
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
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск транспорта</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о транспорте "' . ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name
								. ', номер: ' . $model->license_plate . '"'; ?>
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
                    <!--<a href="#" class="buttonS bBrown" style="margin-top: 15px;margin-left: 15px;">Назад</a>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name ?></span>
                        <i>Зарегистрирован: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy H:m', $model->created_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о транспортном средстве</h5>
                        <span><strong>Транспорт свободен:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
							по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_to); ?></span>
                        <span><strong>Текущее расположение:</strong> <?php echo $model->cities->name_ru ?>, <?php echo $model->regions->name_ru ?>, <?php echo $model->countries->name_ru ?></span>
                        <?php if (!empty($model->citiesTo->name_ru) || !empty($model->regionsTo->name_ru) || !empty($model->countriesTo->name_ru)): ?>
						<span><strong>Готов ехать в:</strong>
							<?php
								$location = array();
								if (!empty($model->citiesTo->name_ru))
									$location[] = $model->citiesTo->name_ru;
								if (!empty($model->regionsTo->name_ru))
									$location[] = $model->regionsTo->name_ru;
								if (!empty($model->countriesTo->name_ru))
									$location[] = $model->countriesTo->name_ru;
							?>
							<?php echo join(', ', $location) ?>
							</span>
						<?php endif; ?>
                        <span><strong>Тип транспорта:</strong> <?php echo $model->vehicleType->name_ru; ?></span>
                        <span><strong>Вид транспорта:</strong> <?php echo $model->categories->name; ?></span>
                        <span><strong>Марка:</strong> <?php echo $model->marka->name; ?></span>
                        <span><strong>Модель:</strong> <?php echo $model->modeli->name; ?></span>
                        <span><strong>Тип кузова:</strong> <?php echo $model->bodyType->name_ru; ?></span>
                        <span><strong>Номер транспорта:</strong> <?php echo $model->license_plate; ?></span>
						<?php if ($model->number_trailer): ?>
							<span><strong>Номер прицепа:</strong> <?php echo $model->number_trailer; ?></span>
						<?php endif; ?>
						<?php if ($model->number_semitrailer): ?>
							<span><strong>Номер полуприцепа:</strong> <?php echo $model->number_semitrailer; ?></span>
						<?php endif; ?>
                        <span><strong>Грузоподъемность:</strong> <?php echo $model->bearing_capacity; ?> т.</span>
                        <span><strong>Объем кузова:</strong> <?php echo $model->body_capacity; ?> м&sup3;</span>
						<?php if (count($shipments)): ?>
							<span><strong>Вид загрузки:</strong> <?php echo join(', ', $shipments); ?></span>
						<?php endif; ?>
						<?php if (count($permissions)): ?>
							<span><strong>Разрешения:</strong> <?php echo join(', ', $permissions); ?></span>
						<?php endif; ?>
                    </div>
					<div class="floatR" style="width:55%; margin:10px;">
							<?php if (count($model->photos)): ?>
								<div class="body" align="center">
									<?php for($i = 0; $i < count($model->photos); $i++): ?>
										<a href="<?php echo '/' . Yii::app()->params['files']['photos'] . '/' . $model->photos[$i]->size_superbig; ?>" class="lightbox" rel="group">
											<img width="80" height="80" src="<?php echo '/' . Yii::app()->params['files']['photos'] . '/' . $model->photos[$i]->size_middle; ?>" alt="<?php echo ucfirst($model->bodyType->name_ru) . " " . $model->marka->name . " " . $model->modeli->name ?>" />
										</a>
									<?php endfor; ?>
								</div>
							<?php endif; ?>
							<div id="map" style="width:100%;height:300px;margin-top: 25px;"></div>
							<div style="float:left;">
								<?php if (!empty($model->citiesTo->id)): ?>
									<label><strong>Общая длина маршрута: </strong><span id="total_length_route"><?php if ($model->citiesTo->latitude) echo 0; ?></span></label>
								<?php endif; ?>
							</div>
							<div style="float:right;">
								<?php if (!empty($model->citiesTo->id)): ?>
									<label><strong>Срелнее время в пути: </strong><span id="total_time_route"><?php if ($model->citiesTo->latitude) echo 0; ?></span></label>
								<?php endif; ?>
							</div>
					</div>
                    <div class="inFrom" style="width:100%">
						<h5>Владелец транспортного средства</h5>
						<span>
							<?php echo $model->user->profiles->last_name . ' ' . $model->user->profiles->first_name . ' ' . $model->user->profiles->middle_name; ?>
						</span>
						<span><?php echo $model->user->profiles->userType->name_ru; ?></span>
						<span><?php echo $model->user->organizations->name_org; ?></span>
						<span class="number">Мобильный телефон: <strong class="red"><?php echo $model->user->profiles->mobile ?></strong></span>
						<span>На сайте с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?></span>
                    </div>

                    <?php /*
					<div class="inFrom" style="width:100%">
						<h5>Дополнительное описание</h5>
						<p>
							<?php echo $model->description; ?>
						</p>
                    </div>
					 *
					 */?>
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
				<?php if ($model->user->vehicles && count($model->user->vehicles) > 1): ?>
					<div class="inFrom" style="width:100%">
						<h5>Другие транспортные средства этого пользователя</h5>
					</div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight" style="text-align: center;">
						<thead>
							<tr>
								<td width="10%">Фото</td>
								<td width="25%">Название</td>
								<td width="40%">Расположение</td>
								<td width="25%">Характеристики</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach($model->user->vehicles as $vehicle): ?>
								<?php if (!$vehicle->is_deleted && $vehicle->id != $model->id): ?>
									<tr>
										<td>
											<a href="/vehicle/view/<?php echo $vehicle->slug; ?>" class="tipS" title="Перейти на страницу транспортного средства" style="display: block;">
												<?php $image = isset($vehicle->photos[0])
													? '/' . Yii::app()->params['files']['photos'] . '/' . $vehicle->photos[0]->size_middle
													: '/images/nophoto.jpg' ?>
												<img src="<?php echo $image; ?>" alt="" />
											</a>
										</td>
										<td>
											<a href="/vehicle/view/<?php echo $vehicle->slug; ?>" class="tipS" title="Перейти на страницу транспортного средства">
												<?php echo ucfirst($vehicle->vehicleType->name_ru) . " " . $vehicle->marka->name . " " . $vehicle->modeli->name ?>
											</a><br/>
											<strong>Добавлен:</strong><br/>
											<span>
												<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $vehicle->updated_at); ?>&nbsp;
												<?php echo Yii::app()->dateFormatter->format('HH:mm', $vehicle->updated_at); ?>
											</span>
										</td>
										<td>
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
										<td>
											<span><strong>Тип кузова: </strong>
												<?php echo $vehicle->bodyType->name_ru ?>
											</span>
											<span><strong>Вид загрузки: </strong>
												<?php echo $vehicle->shipmentsNames ?>
											</span>
											<span><strong>Объем кузова: </strong>
												<?php echo $vehicle->body_capacity ?> м&sup3;
											</span>
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