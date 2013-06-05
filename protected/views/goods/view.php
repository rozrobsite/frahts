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
			.add('mapTools');

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
                        <i>Добавлено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy H:m', $model->updated_at); ?></i>
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
                        <span><strong>Подходящие виды загрузки:</strong> <?php echo $shipments; ?></span>
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
						<span><strong>Требуемые разрешения:</strong> <?php echo $permissions; ?></span>
						<span><strong>Оплата:</strong> <?php echo $model->cost . ' ' . $model->currency->name_ru . ' (' . $model->paymentType->name_ru . ')'; ?></span>
                    </div>
					<div class="floatR" style="width:50%;height:430px; margin:10px;">
						<div id="map" style="width:100%;height:430px;">

						</div>
						<div>
							<label><strong>Общая длина маршрута: </strong><span id="total_length_route"></span></label>
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
                    <div class="clear"></div>
                </div>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight">
                    <thead>
                        <tr>
                            <td width="30%">Product</td>
                            <td width="42%">Descrition</td>
                            <td width="19%">Discount</td>
                            <td width="9%">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Concept</td>
                            <td>Creating project concept and logic</td>
                            <td>0</td>
                            <td><strong>$1100</strong></td>
                        </tr>
                        <tr>
                            <td>General design</td>
                            <td>Design prototype</td>
                            <td>0</td>
                            <td><strong>$2000</strong></td>
                        </tr>
                        <tr>
                            <td>Front end development</td>
                            <td>Coding and connecting front end</td>
                            <td>0</td>
                            <td><strong>$1600</strong></td>
                        </tr>
                        <tr>
                            <td>Database</td>
                            <td>Creating and connecting database</td>
                            <td>0</td>
                            <td><strong>$890</strong></td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <div class="inFrom">
                        <h5>Payment method: <i class="red">Wire transfer</i></h5>
                        <span>Bank account #</span>
                        <span>SWIFT code</span>
                        <span>IBAN</span>
                        <span>Billing address</span>
                        <span>Name</span>
                    </div>

                    <div class="total">
                        <span>Amount Due</span>
                        <strong class="red">$00.00</strong>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inFooter">
                    <div class="footnote">Thank you very much for choosing us. It was pleasure to work with you.</div>
                    <ul class="cards">
                        <li class="discover"><a href="#"></a></li>
                         <li class="visa"><a href="#"></a></li>
                         <li class="mc"><a href="#"></a></li>
                         <li class="pp"><a href="#"></a></li>
                         <li class="amex"><a href="#"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- Content ends -->
