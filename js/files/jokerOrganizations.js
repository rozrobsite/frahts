var jokerCountry =
    {
        init: function()
        {
            $('#jokerCountry').on('change', function(e) {
                $.post('/location/region', {
                    country_id: $('#jokerCountry').val()
                }, function(response) {
                    if (response == null)
                        return;

                    $response = $(response).html();
                    $('#jokerRegion').html($response);

                    updateSelect.update($('#jokerRegion'));

                    $('#jokerRegion').change();
                    
                    if (placemark) {
                        jokerMap.geoObjects.remove(placemark);
                    }

                    if ($('#jokerCountry').val())
                    {
                        ymaps.geocode($('#jokerCountry :selected').text(), {results: 1}).then(function(res) {
                            var firstGeoObject = res.geoObjects.get(0);

                            jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 5);
                        });
                    }
                    else
                    {
                        jokerMap.setCenter([0, 0], 1);
                    }

                    $('#jokerAddress').val('');
                    $('#jokerAddress').attr('disabled');
                });
            });
        }
    };

var jokerRegion =
    {
        init: function()
        {
            $('#jokerRegion').on('change', function(e) {
                $.post('/location/city', {
                    region_id: $('#jokerRegion').val()
                }, function(response) {
                    if (response == null)
                        return;

                    $response = $(response).html();
                    $('#jokerCity').html($response);

                    updateSelect.update($('#jokerCity'));
                    
                    if (placemark) {
                        jokerMap.geoObjects.remove(placemark);
                    }
                    
                    if ($('#jokerRegion').val())
                    {
                        ymaps.geocode($('#jokerCountry :selected').text() + ', ' + $('#jokerRegion :selected').text(), {results: 1}).then(function(res) {
                            var firstGeoObject = res.geoObjects.get(0);

                            jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 5);
                        });
                    }
                    else
                    {
                        if ($('#jokerCountry').val())
                        {
                            ymaps.geocode($('#jokerCountry :selected').text(), {results: 1}).then(function(res) {
                                var firstGeoObject = res.geoObjects.get(0);

                                jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 5);
                            });
                        }
                        else
                        {
                            jokerMap.setCenter([0, 0], 1);
                        }
                    }

                    $('#jokerAddress').val('');
                    $('#jokerAddress').attr('disabled');
                });
            });
        }
    };

var jokerCity =
    {
        init: function()
        {
            $('#jokerCity').on('change', function(e) {
                if (placemark) {
                    jokerMap.geoObjects.remove(placemark);
                }
                
                if ($('#jokerCity').val())
                {
                    $('#jokerAddress').val('');

                    ymaps.geocode($('#jokerCountry :selected').text() + ', ' + $('#jokerRegion :selected').text() + ', ' + $('#jokerCity :selected').text(),
                        {results: 1}).then(function(res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 12);
                    });

                    $('#jokerAddress').removeAttr('disabled');
                }
                else
                {
                    ymaps.geocode($('#jokerCountry :selected').text() + ', ' + $('#jokerRegion :selected').text(), {results: 1}).then(function(res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 5);
                    });

                    $('#jokerAddress').val('');
                    $('#jokerAddress').attr('disabled');
                }

            });
        }
    }


var jokerAddress =
    {
        init: function()
        {
            $('#jokerAddress').on('blur', function(e) {
                var address = $('#jokerCountry :selected').text() +
                    ', ' + $('#jokerRegion :selected').text() +
                    ', ' + $('#jokerCity :selected').text() +
                    ', ' + $(this).val();
                
                if ($('#jokerCountry').val() && $('#jokerRegion').val() && $('#jokerCity').val() && $('#jokerAddress').val())
                {
                    ymaps.geocode(address, {results: 1}).then(function(res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        var coords = firstGeoObject.geometry.getCoordinates();
                        jokerMap.setCenter(coords, 18);

                        if (placemark) {
                            jokerMap.geoObjects.remove(placemark);
                        }
                        
                        $('#jokerLatitude').val(coords[0]);
                        $('#jokerLongitude').val(coords[1]);
                        
                        placemark = new ymaps.Placemark(coords,
                            {
                                balloonContent: address
                            },
                            {
                                iconImageHref: '/images/home_icon.png',
                                iconImageSize: [32, 37]
                            }
                        );
                        jokerMap.geoObjects.add(placemark);
                    });
                }
            });
        }
    }

ymaps.ready(init);

var names = [];
function init()
{
    jokerMap = new ymaps.Map('jokerMap', {
        center: jokerCenter,
        zoom: 1
    });

    jokerMap.controls.add('zoomControl');
    
    var address = $('#jokerCountry :selected').text() +
                    ', ' + $('#jokerRegion :selected').text() +
                    ', ' + $('#jokerCity :selected').text() +
                    ', ' + $('#jokerAddress').val();
      
    if ($('#jokerCountry').val() || $('#jokerRegion').val() || $('#jokerCity').val() || $('#jokerAddress').val())
    {
        ymaps.geocode(address, {results: 1}).then(function(res) {
            var firstGeoObject = res.geoObjects.get(0);

            var coords = firstGeoObject.geometry.getCoordinates();
            jokerMap.setCenter(coords, 15);
            
            $('#jokerAddress').removeAttr('disabled');

            if (placemark) {
                jokerMap.geoObjects.remove(placemark);
            }
            
            if ($('#jokerAddress').val())
            {
                placemark = new ymaps.Placemark(coords,
                    {
                        balloonContent: address
                    },
                    {
                        iconImageHref: '/images/home_icon.png',
                        iconImageSize: [32, 37]
                    }
                );
                jokerMap.geoObjects.add(placemark);
                
                jokerMap.setCenter(coords, 18);
            }
        });
    }
    
    jokerMap.events.add('click', function (e) {
        var coords = e.get('coordPosition');

        // Отправим запрос на геокодирование.
        ymaps.geocode(coords).then(function (res) {
            var names = [];
            // Переберём все найденные результаты и
            // запишем имена найденный объектов в массив names.
            res.geoObjects.each(function (obj) {
                names.push(obj.properties.get('name'));
            });
            
            // Добавим на карту метку в точку, по координатам
            // которой запрашивали обратное геокодирование.
            if (placemark)
                jokerMap.geoObjects.remove(placemark);
            
            $('#jokerAddress').val('');
            $('#jokerAddress').val(names[0]);
            $('#jokerLatitude').val(coords[0]);
            $('#jokerLongitude').val(coords[1]);
            
            placemark = new ymaps.Placemark(coords, {
                // В качестве контента иконки выведем
                // первый найденный объект.
//                iconContent:names[0],
                // А в качестве контента балуна - подробности:
                // имена всех остальных найденных объектов.
                balloonContent:names.reverse().join(', ')
            }, {
                iconImageHref: '/images/home_icon.png',
                iconImageSize: [32, 37],
                balloonMaxWidth:'250'
            });
            
            jokerMap.geoObjects.add(placemark);
        });
    });
}

$(document).ready(function() {
    $('#jokerCountry').change();
    jokerCountry.init();
    jokerRegion.init();
    jokerCity.init();
    jokerAddress.init();
});