// Как только будет загружен API и готов DOM, выполняем инициализацию
ymaps.ready(init);

function init () {
	myMap = new ymaps.Map("map", {
		center: center,
		zoom: 12
	});
	
	myPlacemark = new ymaps.Placemark(center, { content: cityname, balloonContent: cityname });

	myMap.controls
	// Кнопка изменения масштаба — компактный вариант
	.add('zoomControl')
	// Список типов карты
//	.add('typeSelector')
	.add('mapTools')
//	.add('routeEditor')
//	.add('trafficControl')
	;
/*
	var myGeocoder = ymaps.geocode('Новый Арбат, 10');
	myGeocoder.then(
		function (res) {
			var coords = res.geoObjects.get(0).geometry.getCoordinates();
			var myGeocoder = ymaps.geocode(coords, {kind: 'street'});
			myGeocoder.then(
				function (res) {
					var street = res.geoObjects.get(0);
					var name = street.properties.get('name');
					// Будет выведено «улица Большая Молчановка»,
					// несмотря на то, что обратно геокодируются
					// координаты дома 10 на ул. Новый Арбат.
					alert(name);
				}
 */     



//	myMap.geoObjects.add(myPlacemark);
	
	
	return false;
}