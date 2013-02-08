var makes = 
{
	init: function()
	{
		$('#Vehicle_make_id').on('change', function(e){
			$.post('/makemodel/model', {
				make_id: $('#Vehicle_make_id').val()
			}, function(response){
				if(response == null) return;

				$('select.model').html(response);
				
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

$(document).ready(function(){
	$('#Vehicle_make_id').change();
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