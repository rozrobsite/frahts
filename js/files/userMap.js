// Как только будет загружен API и готов DOM, выполняем инициализацию
ymaps.ready(init);

function init () {

    ymaps.geocode(cityname+' '+address, { results: 1 }).then(function (res) {
        // Выбираем первый результат геокодирования.
        var firstGeoObject = res.geoObjects.get(0);
        // Создаем карту с нужным центром.
        var coords = firstGeoObject.geometry.getCoordinates();
		myMap = new ymaps.Map("map", {
                center: coords,
                zoom: 12
            });
			
		myMap.controls
		// Кнопка изменения масштаба — компактный вариант
		.add('zoomControl')
		// Список типов карты
		.add('typeSelector')
		.add('mapTools')
		.add('routeEditor')
	//	.add('trafficControl')
		;
		
		var myPlacemark = new ymaps.Placemark(coords, { balloonContent: address });
		myMap.geoObjects.add(myPlacemark);
	});

	
	return false;
}