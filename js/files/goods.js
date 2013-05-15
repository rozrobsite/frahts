var countryFrom = 
{
	init: function()
	{
		$('#Goods_country_id_from').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Goods_country_id_from').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionFrom').html($response);

				updateSelect.update($('select.regionFrom'));
				
				$('#Goods_region_id_from').change();
			});
		});
	}
};

var regionFrom = 
{
	init: function()
	{
		$('#Goods_region_id_from').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#Goods_region_id_from').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityFrom').html($response);

				updateSelect.update($('select.cityFrom'));
			});
		});
	}
};

var countryTo = 
{
	init: function()
	{
		$('#Goods_country_id_to').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Goods_country_id_to').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionTo').html($response);

				updateSelect.update($('select.regionTo'));
				
				$('#Goods_region_id_to').change();
			});
		});
	}
};

var regionTo = 
{
	init: function()
	{
		$('#Goods_region_id_to').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#Goods_region_id_to').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityTo').html($response);

				updateSelect.update($('select.cityTo'));
			});
		});
	}
};

var adr = 
{
	init: function()
	{
		$('#permission_good_4').on('change', function(e){
			if ($(this).attr('checked'))
			{
				$('#Goods_adr').show();
			}
			else
			{
				$('#uniform-Goods_adr span').html(0);
				$('#Goods_adr').val(0);
				$('#Goods_adr').hide();
			}
		});
	}
}

$(document).ready(function(){
	$('#Goods_country_id_from').change();
	countryFrom.init();
	regionFrom.init();
	$('#Goods_country_id_to').change();
	countryTo.init();
	regionTo.init();
	
	adr.init();
	$('#permission_good_4').change();
	
//	$("#goodsReset").click();
	
//	$('div.ui-dialog').offset({top: $('div.ui-dialog').top + 46 + 'px'});
//	alert($('div.ui-dialog').offset());
});

