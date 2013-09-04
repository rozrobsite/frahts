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
		}

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

		pointBegin.properties.set('balloonContentBody', $('#point_sent').val());
		pointEnd.properties.set('balloonContentBody', $('#point_arrival').val());

		var goods = sendCoordinates(incidental_goods);

//		for (var good in goods)
//		{
//
//			var placemark = new YMaps.Placemark(new YMaps.GeoPoint(good.lat,good.lng));
//			placemark.name = "Москва";
//			placemark.description = "Столица Российской Федерации";
//
//			// Добавляет метку на карту
//			myMap.addOverlay(placemark);
//		}

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
		response = $.parseJSON(response);
		if (typeof response.error === 'undefined' || response.error > 0 || typeof response.goods === 'undefined' )
		{
			return;
		}

		var goods = response.goods;

		var content = '';
		for (var index in goods)
		{
			var good = goods[index];
			content += '<a href="/goods/view/' + good.slug + '" class="tipS" title="Перейти на страницу груза"><strong>' + good.name + '</strong></a><br/>';
			content += good.date_from + ' - ' + good.date_to + '<br/>';
			content += '<strong>Откуда:</strong> ' + good.city_from + ', ' + good.region_from + ', ' + good.country_from + '<br/>';
			content += '<strong>Куда:</strong> ' + good.city_to + ', ' + good.region_to + ', ' + good.country_to + '<br/>';

			if (good.weight_exact_value > 0)
				content += '<strong>Вес:</strong> ' + good.weight_exact_value + ' т.' + '<br/>';
			else
				content += '<strong>Вес:</strong> ' + 'от ' + good.weight_from + ' т. до ' + good.weight_to + ' т.<br/>';
			if (good.capacity_exact_value > 0)
				content += '<strong>Объем:</strong> ' + good.capacity_exact_value + ' м&sup3;' + '<br/>';
			else
				content += '<strong>Объем:</strong> ' + good.capacity_from + ' - ' + good.capacity_to + ' м&sup3;<br/>';
			content += '<strong>Оплата:</strong> ' + good.cost + ' ' + good.currency + ' (' + good.payment + ')<br/>';

			if (response.access)
			{
				if (good.is_dispatcher)
					content += '<strong>Комиссия:</strong> ' + good.fee + '<br/>';
				content += '<span style="font-style:italic">' + good.owner_name + ' (' + good.owner_type + '), моб.: <strong>' + good.mobile + '</strong><span><br/><br/>';
			}

			content += '<a href="/goods/view/' + good.slug + '" class="tipS" title="Перейти на страницу груза">Страница груза</a>';

			var placemark = new ymaps.Placemark(
				[good.lat,good.lng],
				{
					//iconContent: goods[index].city_from,
					balloonContent: content
				},
				{
					// Опции.
					// Своё изображение иконки метки.
					iconImageHref: '/images/truck_icon.png',
					// Размеры метки.
					iconImageSize: [32, 37]
					// Смещение левого верхнего угла иконки относительно
					// её "ножки" (точки привязки).
//					iconImageOffset: [-3, -42]
				}
			);
//			placemark.name = "Москва";
//			placemark.description = "Столица Российской Федерации";

			// Добавляет метку на карту
			myMap.geoObjects.add(placemark);

			content = '';
		}

	});
}