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
                    alert(address);
                    if ($('#jokerCountry').val() && $('#jokerRegion').val() && $('#jokerCity').val() && $('#jokerAddress').val())
                    {
                        ymaps.geocode(address, {results: 1}).then(function(res) {
                            var firstGeoObject = res.geoObjects.get(0);

                            jokerMap.setCenter(firstGeoObject.geometry.getCoordinates(), 15);

                            var myPlacemark = new ymaps.Placemark(firstGeoObject.geometry.getCoordinates(),
                                    {
                                        balloonContent: address
                                    },
                            {
                                iconImageHref: '/images/home_icon.png',
                                iconImageSize: [32, 37]
                            }
                                    );
                            myMap.geoObjects.add(myPlacemark);
                        });
                    }
                });
            }
        }

ymaps.ready(init);

function init()
{
    jokerMap = new ymaps.Map('jokerMap', {
        center: jokerCenter,
        zoom: 1
    });

    jokerMap.controls.add('zoomControl');
}

$(document).ready(function() {
    $('#jokerCountry').change();
    jokerCountry.init();
    jokerRegion.init();
    jokerCity.init();
    jokerAddress.init();
});