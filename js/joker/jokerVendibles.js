var vendibles =
{
	add: function()
	{
		$('#vendibles-form').on('submit', function(e){
			$.ajax({
				type: 'post',
				url: location.href,
				data: $(this).serialize(),
				beforeSend: function(data){
					blockElement($('.fluid'));
					$('div.error').text('');
					$('input.error').removeClass('error');
				},
				success: function(response){
					if (typeof response.error === 'undefined' || response.error == 1)
					{
						$.jGrowl('Не удалось добавить товар. Попробуйте позже.', {
							header: 'Ошибка',
							life: 15000,
							theme: 'errorMessage'
						});

						return;
					}

					if (response.error == 2 && typeof response.errors !== 'undefined')
					{
						var errors = response.errors;

						$.each(errors, function(fieldName, errorText){
							$('#error_' + fieldName).html(errorText);
							$('#' + fieldName).addClass('error');
						});

						return;
					}

					$.jGrowl('Товар добавлен.', {
						header: 'Сообщение',
						life: 15000,
						theme: 'successMessage'
					});

					$('input[type="text"]').val('');

					if (typeof response.vendibles !== 'undefined' && response.vendibles)
					{
						$('#vendibles').html(response.vendibles);

						vendibles.update();
						vendiblesDialog.init();
                        vendibles.remove();
                        $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
                        $('.tipS').tipsy({gravity: 's',fade: true, html:true});
                        $('.tipW').tipsy({gravity: 'w',fade: true, html:true});
                        $('.tipE').tipsy({gravity: 'e',fade: true, html:true});

						$('select.currency').uniform();
					}
				}
			}).done(function(response){
				unblockElement($('.fluid'));
			});

			return false;
		});
	},
	update: function()
	{
		$('.jokerVendibleUpdate').on('click', function(e){
			var vendibleId = $(this).data('id');

			$.ajax({
				type: 'post',
				url: '/joker/user/vendiblesUpdate',
				data: {
					id: vendibleId,
					name: $('#vendible_name_' + vendibleId).val(),
					description: $('#vendible_description_' + vendibleId).val(),
					cost: $('#vendible_cost_' + vendibleId).val(),
					currency_id: $('#vendible_currency_' + vendibleId).val()
				},
				beforeSend: function(data){
					blockElement($('#vendibles'));
					$('div.error').text('');
					$('input.error').removeClass('error');
				},
				success: function(response){
					if (typeof response.error === 'undefined' || response.error == 1)
					{
						$.jGrowl('Не удалось изменить данные о товаре. Попробуйте позже.', {
							header: 'Ошибка',
							life: 15000,
							theme: 'errorMessage'
						});

						return;
					}

					if (response.error == 2 && typeof response.errors !== 'undefined')
					{
						var errors = response.errors;

						$.each(errors, function(fieldName, errorText){
							$('#error_vendible_' + fieldName + '_' + vendibleId).html(errorText);
							$('#vendible_' + fieldName + '_' + vendibleId).addClass('error');
						});

						return;
					}

					$.jGrowl('Данные о товаре изменены.', {
						header: 'Сообщение',
						life: 15000,
						theme: 'successMessage'
					});

					if (typeof response.vendibles !== 'undefined' && response.vendibles)
					{
						$('#vendibles').html(response.vendibles);

						vendibles.update();
						vendiblesDialog.init();
                        vendibles.remove();
                        $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
                        $('.tipS').tipsy({gravity: 's',fade: true, html:true});
                        $('.tipW').tipsy({gravity: 'w',fade: true, html:true});
                        $('.tipE').tipsy({gravity: 'e',fade: true, html:true});
					}
				}
			}).done(function(response){
				unblockElement($('#vendibles'));
			});
		});
	},
	remove: function()
	{
		$('.jokerVendibleDelete').on('click', function(){
			$('#confirm_dialog').data('vendibleId', $(this).data('id')).dialog('open');
		});
	},
	init: function()
	{
		vendibles.add();
		vendibles.update();
		vendibles.remove();
	}
};

var vendiblesDialog =
{
	init: function()
	{
		$('#confirm_dialog').dialog({
			autoOpen: false,
			modal: true,
			width: 400,
			buttons: {
				"Да": function() {
					var dialog = $(this);
					var vendibleId = dialog.data('vendibleId');

					$.ajax({
						type: 'post',
						url: '/joker/user/vendiblesDelete',
						data: {
							id: vendibleId
						},
						beforeSend: function(data){
							blockElement($('#vendibles'));
						},
						success: function(response){
							if (typeof response.error === 'undefined' || response.error > 0)
							{
								$.jGrowl('Не удалось удалить товар. Попробуйте позже.', {
									header: 'Ошибка',
									life: 15000,
									theme: 'errorMessage'
								});

								return;
							}

							$.jGrowl('Товар удален.', {
								header: 'Сообщение',
								life: 15000,
								theme: 'successMessage'
							});

							$('tr.vendible_' + vendibleId).remove();

							if (!$('table.vendiblesTable tbody tr').length) {
                                $('table.vendiblesTable').parent().remove();
                            }

							dialog.dialog('close');
						}
					}).done(function(response){
						unblockElement($('#vendibles'));
					});
				},
				"Нет": function() {
					$(this).dialog("close");
				}
			}
		});
	}
}

$(document).ready(function() {
	vendiblesDialog.init();
	vendibles.init();

});