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
	.add('routeEditor')
	.add('trafficControl');

	var points = [];
	points.push(start);
	if (typeof end != 'undefined')
		points.push(end);

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

		myMap.geoObjects.add(route);

		$('#total_length_route').html(route.getHumanLength());
		$('#total_time_route').html(route.getHumanTime());
		// С помощью метода getWayPoints() получаем массив точек маршрута
		// (массив транзитных точек маршрута можно получить с помощью метода getViaPoints)
		var points = route.getWayPoints();
		// Задаем стиль метки - иконки будут красного цвета, и
		// их изображения будут растягиваться под контент
//		points.options.set('preset', 'twirl#blueStretchyIcon');
		// Задаем контент меток в начальной и конечной точках
		var pointBegin = points.get(0);
		var pointEnd = points.get(1);

		pointBegin.options.set('preset',{iconImageHref: '/images/vehicle_from.png', iconImageSize: [32, 32]});
		pointEnd.options.set({iconImageHref: '/images/vehicle_to.png', iconImageSize: [32, 32]});
		pointBegin.properties.set({iconContent: null, balloonContentBody: $('#point_sent').val()});
		pointEnd.properties.set({iconContent: null, balloonContentBody: $('#point_arrival').val()});

	//				pointBegin.options.set('draggable', true);
	//				pointEnd.options.set('draggable', true);
	}, function (error) {

		});

	return false;
}