var countryLocationVehicle =
{
	init: function()
	{
		$('#vcoid').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#vcoid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionLocationVehicle').html($response);

				updateSelect.update($('select.regionLocationVehicle'));

				$('#vrid').change();
			});
		});
	}
};

var regionLocationVehicle =
{
	init: function()
	{
		$('#vrid').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#vrid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityLocationVehicle').html($response);

				updateSelect.update($('select.cityLocationVehicle'));
			});
		});
	}
};

var countryFilterVehicle =
{
	init: function()
	{
		$('#fvcoid').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#fvcoid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionFilterVehicle').html($response);

				updateSelect.update($('select.regionFilterVehicle'));

				$('#fvrid').change();
			});
		});
	}
};

var regionFilterVehicle =
{
	init: function()
	{
		$('#fvrid').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#fvrid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityFilterVehicle').html($response);

				updateSelect.update($('select.cityFilterVehicle'));
			});
		});
	}
};

$(document).ready(function(){
//	$('#vcoid').change();
	countryLocationVehicle.init();
	regionLocationVehicle.init();

//	$('#fvcoid').change();
	countryFilterVehicle.init();
	regionFilterVehicle.init();

});