var categories =
{
	init: function()
	{
		$('#Vehicle_category_id').on('change', function(e){
			$.post('/makemodel/categories', {
				category_id: $('#Vehicle_category_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();

				$('select.make').html($response);

				updateSelect.update($('select.make'));

				$('#Vehicle_make_id').change();
			});
		});
	}
}

var makes =
{
	init: function()
	{
		$('#Vehicle_make_id').on('change', function(e){
			$.post('/makemodel/model', {
				category_id: $('#Vehicle_category_id').val(),
				make_id: $('#Vehicle_make_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.model').html($response);

				updateSelect.update($('select.model'));
			});
		});
	}
};

var vehicle =
{
	deleteSearch: function()
	{
		$('.vehicleDeleteSearch').each(function(e){
			$(this).on('click', function(){
				if (confirm('Вы действительно хотите удалить это транспортное средство из поиска?'))
				{
					$.post('/makemodel/delete', {
						id: $(this).attr('rel')
					}, function(response){
						if(response == null) return;

						window.location.reload();

					});
				}
			})
		});
	},
	returnSearch: function()
	{
		$('.vehicleReturnSearch').each(function(e){
			$(this).on('click', function(){
				if (confirm('Вы действительно хотите вернуть это транспортное средство в поиск?'))
				{
					$.post('/makemodel/return', {
						id: $(this).attr('rel')
					}, function(response){
						if(response == null) return;

						window.location.reload();

					});
				}
			})
		});
	},

	deleteBase: function()
	{
		if (!$('.vehicleDeleteBase').length) return;

		$('.vehicleDeleteBase').each(function(e){
			$(this).on('click', function(){
				if (confirm('Вы действительно хотите удалить это транспортное средство из базы? Внимание! Данные будут полностью удалены и востановлению не подлежат!'))
				{
					$.post('/makemodel/deletebase', {
						id: $(this).attr('rel')
					}, function(response){
						if(response == null) return;

						window.location.reload();

					});
				}
			})
		});
	},

	deleteManySearch: function()
	{
		if (!$('#vehicleDeleteSearchAction').length) return;

		$('#vehicleDeleteSearchAction').on('change', function(e){
			if ($(this).val() != 1)
			{
				return;
			}

			var checkedIds = '';
			$('.vehicleChecked').each(function(e){
				checkedIds += $(this).attr('checked') ? $(this).data('id') + ',' : '';
			});

			if (checkedIds == '') return;

			$.post('/makemodel/deletemany', {
				ids: checkedIds
			}, function(response){
				if(response == null) return;

				window.location.reload();

			});
		});
	},

	returnManySearch: function()
	{
		if (!$('#vehicleReturnSearchAction').length) return;

		$('#vehicleReturnSearchAction').on('change', function(e){
			if ($(this).val() != 1)
			{
				return;
			}

			var checkedIds = '';
			$('.vehicleChecked').each(function(e){
				checkedIds += $(this).attr('checked') ? $(this).data('id') + ',' : '';
			});

			if (checkedIds == '') return;

			$.post('/makemodel/returnmany', {
				ids: checkedIds
			}, function(response){
				if(response == null) return;

				window.location.reload();

			});
		});
	},

	adr: function()
	{
		$('#permission_4').on('change', function(e){
			if ($(this).attr('checked'))
			{
				$('#Vehicle_adr').show();
			}
			else
			{
				$('#uniform-Vehicle_adr span').html(0);
				$('#Vehicle_adr').val(0);
				$('#Vehicle_adr').hide();
			}
		});
	}
};

var photo =
{
	deletePreviewUpload: function(object){
		var filename = $(object).attr('rel');
		$.post('/makemodel/deletePreviewUpload', {
			filename: filename
		}, function(response){
			if(response == null) return;
			if (response)
			{
				$('.delClass[data-filename="' + filename + '"]').remove();
			};
		});
	},
	deletePhotos: function(){
		if (!$('.deletePhoto').length) return;

		$('.deletePhoto').each(function(e){
			$(this).on('click', function(e){
				var id = $(this).attr('rel');
				$.post('/makemodel/deletePhoto', {
					id: id
				}, function(response){
					if(response == null) return;
					if (response)
					{
						$('.photo_' + id).remove();
					};
				});
			});

		});
	}
}

var countryVehicleFrom =
{
	init: function()
	{
		$('#Vehicle_country_id').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Vehicle_country_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionFrom').html($response);

				updateSelect.update($('select.regionFrom'));

				$('#Vehicle_region_id').change();
			});
		});
	}
};

var regionVehicleFrom =
{
	init: function()
	{
		$('#Vehicle_region_id').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#Vehicle_region_id').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityFrom').html($response);

				updateSelect.update($('select.cityFrom'));
			});
		});
	}
};

var countryVehicleTo =
{
	init: function()
	{
		$('#Vehicle_country_id_to').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#Vehicle_country_id_to').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionTo').html($response);

				updateSelect.update($('select.regionTo'));

				$('#Vehicle_region_id_to').change();
			});
		});
	}
};

var regionVehicleTo =
{
	init: function()
	{
		$('#Vehicle_region_id_to').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#Vehicle_region_id_to').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityTo').html($response);

				updateSelect.update($('select.cityTo'));
			});
		});
	}
};

$(document).ready(function(){
//	$('#Vehicle_make_id').change();
//	makes.init();
	$('#Vehicle_country_id_from').change();
	countryVehicleFrom.init();
	regionVehicleFrom.init();
	$('#Vehicle_country_id_to').change();
	countryVehicleTo.init();
	regionVehicleTo.init();
	$('#Vehicle_category_id').change();
	categories.init();
	makes.init();
	vehicle.deleteSearch();
	vehicle.returnSearch();
	vehicle.adr();
	$('#permission_4').change();
	vehicle.deleteManySearch();
	vehicle.returnManySearch();
	vehicle.deleteBase();
	photo.deletePhotos();

});