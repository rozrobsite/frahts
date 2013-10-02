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

var partner =
{
	add: function()
	{
		$('.add-partner').on('click', function(e){
			var partner_id = $(this).data('id');

			blockElement($('.mytasks'));

			$.post('/partners/add', {
				partner_id: partner_id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0)
				{
					$.jGrowl('Не удалось добавить пользователя к Вам в партнеры. Попробуйте позже', {
						header: 'Ошибка',
						life: 15000,
						theme: 'errorMessage'
					});

					return;
				}

				if (typeof response.isAdd !== 'undefined' && !response.isAdd)
				{
					$.jGrowl('Не удалось добавить пользователя к Вам в партнеры. Попробуйте позже', {
						header: 'Ошибка',
						life: 15000,
						theme: 'errorMessage'
					});

					return;
				}

				$.jGrowl('Пользователь добавлен к Вам в партнеры.', {
					header: 'Сообщение',
					life: 15000,
					theme: 'successMessage'
				});

				$.get(location.href, function(response){
					$('.mytasks').html('');
					$('.mytasks').html($(response).find('.mytasks').html());
				}).done(function(data){
					unblockElement($('.mytasks'));

					partner.init();
				});


			}).done(function(data){

			});
		});
	},
	remove: function()
	{
		$('.remove-partner').on('click', function(e){
			var partner_id = $(this).data('id');

			blockElement($('.mytasks'));

			$.post('/partners/remove', {
				partner_id: partner_id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0)
				{
					$.jGrowl('Не удалось удалить пользователя из Ваших партнеров. Попробуйте позже', {
						header: 'Ошибка',
						life: 15000,
						theme: 'errorMessage'
					});

					return;
				}

				if (typeof response.isAdd !== 'undefined' && !response.isRemove)
				{
					$.jGrowl('Не удалось удалить пользователя из Ваших партнеров. Попробуйте позже', {
						header: 'Ошибка',
						life: 15000,
						theme: 'errorMessage'
					});

					return;
				}

				$.jGrowl('Пользователь удален из Ваших партнеров.', {
					header: 'Сообщение',
					life: 15000,
					theme: 'successMessage'
				});

				$.get(location.href, function(response){
					$('.mytasks').html('');
					$('.mytasks').html($(response).find('.mytasks').html());
				}).done(function(data){
					unblockElement($('.mytasks'));

					partner.init();
				});


			}).done(function(data){

			});
		});
	},
	init: function()
	{
		partner.add();
		partner.remove();
	}
}

$(document).ready(function(){
	$('#partnerSearchCountry').change();
	partnerSearchCountry.init();
	partnerSearchRegion.init();
	partner.init();
});