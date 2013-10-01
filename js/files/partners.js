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

				updateSelect.update($('#partnerSearchRegion'));

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

				updateSelect.update($('#partnerSearchCity'));
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

var partnerView =
{
	init: function()
	{
		$('.partner-item').on('click', function(e){
			var partner_id = $(this).data('partner-id');

			blockElement($('#partnerView'));

			$.post('/partners/view', {
				partner_id: partner_id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0)
					return;

				$('#partnerView').html('');
				$('#partnerView').html($(response.view).find('.widget').html());
			}).done(function(data){
				unblockElement($('#partnerView'));
				$('#scrollUp').click();
			});
		});
	}
}

$(document).ready(function(){
	$('#partnerSearchCountry').change();
	partnerSearchCountry.init();
	partnerSearchRegion.init();
//	partnerView.init();
});