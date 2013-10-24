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
					if ($('.partnerTitle').length) {
						$('.partnerTitle').html('');
						$('.partnerTitle').html($(response).find('.partnerTitle').html());
					}
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
					if ($('.partnerTitle').length) {
						$('.partnerTitle').html('');
						$('.partnerTitle').html($(response).find('.partnerTitle').html());
					}
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
	partner.init();
});