var countryFrom = 
{
	init: function()
	{
		$('#Goods_country_id_from').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Goods_country_id_from').val()
			}, function(response){
				if(response == null) return;

				$('select.regionFrom').html(response);

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

				$('select.cityFrom').html(response);

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

				$('select.regionTo').html(response);

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

				$('select.cityTo').html(response);

				updateSelect.update($('select.cityTo'));
			});
		});
	}
};

$(document).ready(function(){
	$('#Goods_country_id_from').change();
	countryFrom.init();
	regionFrom.init();
	$('#Goods_country_id_to').change();
	countryTo.init();
	regionTo.init();
	
//	$("#goodsReset").click();
	
//	$('div.ui-dialog').offset({top: $('div.ui-dialog').top + 46 + 'px'});
//	alert($('div.ui-dialog').offset());
});

