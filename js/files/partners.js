var partnerSearchCountry =
{
	init: function()
	{
		$('#partnerSearchCountry').on('change', function(e){
			$.post('/location/region', {
				country_id: $(this).val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('#partnerSearchRegion').html($response);

				updateSelect.update($('partnerSearchRegion'));

				$('#partnerSearchRegion').change();
			});
		});
	}
};

var partnerSearchRegion =
{
	init: function()
	{
		$('#partnerSearchRegion').on('change', function(e){
			$.post('/location/city', {
				region_id: $(this).val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('#partnerSearchCity').html($response);

				updateSelect.update($('partnerSearchCity'));
			});
		});
	}
};

var partnerSearch =
{
	init: function()
	{
		$('#searchPartnersForm').on('submit', function(e){
			$.post('/partners/find', {
				data: $(this).serialize()
			}, function(response){

			});

			return false;
		});
	}
};

$(document).ready(function(){
	partnerSearchCountry.init();
	partnerSearchRegion.init();
	partnerSearch.init();
});