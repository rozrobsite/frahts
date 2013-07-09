var offer = {
	add: function() {
		$('#offer').on('click', function(e){
			var receiving_user_id = $(this).data('receiving-user-id');
			var model_id = $(this).data('model-id');
			var model_type = $(this).data('model-type');

			$.post('/offers/add', {
				receiving_user_id: receiving_user_id,
				model_id: model_id,
				model_type: model_type
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0 || typeof response.id === 'undefined' || response.id == null || response.id == 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.jGrowl('Ваше предложение отправлено пользователю.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

				$('#offer').hide();
				$('#offer_refuse_message').show();
				$('#offer_refuse').attr('data-id', response.id);
			});
		});
	},
	cancel: function() {
		$('#offer_cancel').on('click', function(){
			var id = $(this).attr('data-id');

			$.post('/offers/cancel', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.jGrowl('Вы отменили предложение для пользователя.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

				$('#offer').show();
				$('#offer_refuse_message').hide();
				$('#offer_refuse').attr('data-id', '');
			});
		});

	},
	accept: function() {
		$('.offerAccept').on('click', function(){
			var id = $(this).attr('data-id');

			$.post('/offers/accept', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.get('/offers', {}, function(response){
					$('#forUserOffersTable').html('');
					$('#forUserOffersTable').html($(response).find('#forUserOffersTable'));

					offer.initForUser();

					$.jGrowl('Вы приняли предложение пользователя.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });
				});
			});
		});
	},
	refuse: function() {
		$('.offerRefuse').on('click', function(){
			var id = $(this).attr('data-id');

			$.post('/offers/refuse', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.jGrowl('Вы отклонили предложение пользователя.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

				$('.acceptOffer_' + id).hide();
				$('.noOffer_' + id).hide();
				$('.refuseOffer_' + id).show();
			});
		});
	},
	cancelForUsersOffer: function() {
		$('.cancelForUsersOffer').on('click', function(){
			var id = $(this).attr('data-id');

			$.post('/offers/cancelForUsersOffer', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.jGrowl('Вы отменили предложение пользователю.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

				$('.acceptOffer_' + id).hide();
				$('.refuseOffer_' + id).hide();
				$('.noOffer_' + id).show();
			});
		});
	},
	cancelUsersOffer: function() {
		$('.cancelUsersOffer').on('click', function(){
			var id = $(this).attr('data-id');

			$.post('/offers/cancelUsersOffer', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.get('/offers', {}, function(response){
					$('#userOffersTable').html('');
					$('#userOffersTable').html($(response).find('#userOffersTable'));

					offer.initUser();

					$.jGrowl('Вы отменили предложение для пользователя.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });
				});
			});
		});

	},
	initForUser: function() {
		offer.accept();
		offer.refuse();
		offer.cancelForUsersOffer();
	},
	initUser: function() {
		offer.cancelUsersOffer();
	},
	init: function(){
		offer.add();
		offer.cancel();
		offer.initForUser();
		offer.initUser();
	}
};

$(document).ready(function(){
	offer.init();
});

