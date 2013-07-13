//var formRegister = {
//	close: function(){
//		$('#formRegister').dialog("close");
//	}
//}
//var thanksRegister = {
//	show: function(){
//		$('#thanksRegister').dialog('open');
//	}  
//};

var user_type = 
{
	init: function()
	{
		$('#Profiles_user_type_id').on('change', function(e){
			switch(parseInt($('#Profiles_user_type_id').val()))
			{
				case 2:
					$('.explanation').hide();
					$('#shipper').show();
					break;
				case 1:
					$('.explanation').hide();
					$('#freighter').show();
					break;
				case 3:
					$('.explanation').hide();
					$('#dispatcher').show();
					break;
				default:
					$('.explanation').hide();
					$('#shipper').show();
			}
		});
	}
};

var country = 
{
	init: function()
	{
		$('#Profiles_country_id').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Profiles_country_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.region').html($response);

				updateSelect.update($('select.region'));
				
				$('#Profiles_region_id').change();
			});
		});
	}
};

var region = 
{
	init: function()
	{
		$('#Profiles_region_id').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#Profiles_region_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.city').html($response);

				updateSelect.update($('select.city'));
			});
		});
	}
};

var review = {
	init: function() {
		$('#positive_review').on('click', function(){
			$('#review_text').attr('data-rating', $(this).data('rating'));
			$('#review_dialog').dialog('open');
		});
		
		$('#negative_review').on('click', function(){
			$('#review_text').attr('data-rating', $(this).data('rating'));
			$('#review_dialog').dialog('open');
		});
	}
}

$(document).ready(function(){
	user_type.init();
	$('#Profiles_user_type_id').change();
	$('#Profiles_country_id').change();
	country.init();
	region.init();
	review.init();
});


