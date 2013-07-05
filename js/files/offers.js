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
	refuse: function() {
		$('#offer_refuse').on('click', function(){
			var id = $(this).data('id');

			$.post('/offers/refuse', {
				id: id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					$.jGrowl('Извините. Возникла непредвиденная ошибка. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					return;
				}

				$.jGrowl('Ваше отказ отправлен пользователю.<br>Просмотреть все предложения вы можете на странице <a href="/offers">"Предложения"</a><br/>Спасибо.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

				$('#offer').show();
				$('#offer_refuse_message').hide();
				$('#offer_refuse').attr('data-id', '');
			});
		});

	},
	init: function(){
		offer.add();
		offer.refuse();
	}
};

$(document).ready(function(){
	offer.init();
});

