var jokerCountry =
{
	init: function()
	{
		$('#jokerCountry').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#jokerCountry').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('#jokerRegion').html($response);

				updateSelect.update($('#jokerRegion'));

				$('#jokerRegion').change();
			});
		});
	}
};

var jokerRegion =
{
	init: function()
	{
		$('#jokerRegion').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#jokerRegion').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('#jokerCity').html($response);

				updateSelect.update($('#jokerCity'));
			});
		});
	}
};

$(document).ready(function(){
	$('#jokerCountry').change();
	jokerCountry.init();
	jokerRegion.init();
});