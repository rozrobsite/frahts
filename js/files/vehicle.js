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
		$('.vehicleDelete').each(function(e){
			$(this).on('click', function(){
				if (confirm('Вы действительно хотите удалить это транспортное средство из поиска?'))
				{
					$.post('/makemodel/delete', {
						id: $(this).attr('rel')
					}, function(response){
						if(response == null) return;

						window.location.href = response.error == 0 
							? '/vehicle/update/' + response.id + '#vehicle_disabled'
							: '/vehicle/update/' + response.id;
							
					});
				}
			})
		});
	},
	returnSearch: function()
	{
		$('.vehicleReturn').each(function(e){
			$(this).on('click', function(){
				if (confirm('Вы действительно хотите вернуть это транспортное средство в поиск?'))
				{
					$.post('/makemodel/return', {
						id: $(this).attr('rel')
					}, function(response){
						if(response == null) return;

						window.location.href = response.error == 0 
							? '/vehicle/update/' + response.id
							: '/vehicle/update/' + response.id + '#vehicle_disabled';
							
					});
				}
			})
		});
	}
}

$(document).ready(function(){
	$('#Vehicle_make_id').change();
	makes.init();
	vehicle.deleteSearch();
	vehicle.returnSearch();
});