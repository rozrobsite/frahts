

// Как только будет загружен API и готов DOM, выполняем инициализацию
ymaps.ready(init);

function init () {
	myMap = new ymaps.Map("map", {
		center: center,
		zoom: 12
	});

	myMap.controls
	// Кнопка изменения масштаба — компактный вариант
	.add('zoomControl')
	// Список типов карты
	.add('typeSelector')
	.add('mapTools')
	.add('trafficControl');


	var points = [];
	points.push(start, end);
	ymaps.route(points, {
		// Опции маршрутизатора
		mapStateAutoApply: true // автоматически позиционировать карту
	}).then(function (router) {
		route && myMap.geoObjects.remove(route);
		route = router;
		route.options.set({
			strokeColor: '0000ffff',
			opacity: 0.9
		});

		var way = route.getPaths().get(0), segments = way.getSegments();

		for (var i = 0; i < segments.length; i++) {
			var coordinates = segments[i].getCoordinates();

			for(var k = 0; k < coordinates.length; k++)
			{
				for(var j = 0; j < coordinates[k].length; j += 2)
				{
					incidental_goods += coordinates[k][j] + ',' + coordinates[k][j + 1] + ';';
				}
			}

//				incidental_goods.push(coordinates);
		//			if (segments[i].getLength() > 60000)
		//				count_coordinates_60 += segments[i].getCoordinates().length;
		//
		//			if (segments[i].getLength() > 140000) {
		//				console.log(segments[i].getLength());
		//				console.log(segments[i].getCoordinates().length);
		//				console.log(segments[i].getCoordinates());
		//			}

		}

		sendCoordinates(incidental_goods);
		//		console.log(count_coordinates);
		//		console.log(count_coordinates_60);

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

		});

	return false;
}

function sendCoordinates(coordinates)
{
	$.post('/goods/incidental', {
		good_id: good_id,
		coordinates: coordinates
	}, function(response){

	});
}