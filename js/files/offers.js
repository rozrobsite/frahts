var offer = {
	add: function() {
		$('#offer').on('click', function(e){
			$('#offer_dialog').dialog('open');
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

					$.jGrowl('Вы приняли предложение пользователя.<br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });
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

				$.jGrowl('Вы отклонили предложение пользователя.<br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

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

				$.jGrowl('Вы отменили предложение пользователю.<br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

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

					$.jGrowl('Вы отменили предложение для пользователя.<br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });
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

var offerDialog = {
	selectGood: function() {
		$('#offerGood').on('change', function(){
			$('#offerCost').val($(this).find(':selected').data('cost'));
			$('#offerCurrency').val($(this).find(':selected').data('currency'));

			updateSelect.update($('#offerCurrency'));
		});
	},
	init: function() {
		offerDialog.selectGood();
	}
};

$(document).ready(function(){
	offer.init();
	offerDialog.init();

	$("#offerCost").mask("9?9999999");
	$('#offerGood').change();
});

