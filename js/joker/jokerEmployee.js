var employee =
	{
		init: function()
		{
			$('#employee-form').on('submit', function(e){
				$.ajax({
					type: 'post',
					url: location.href,
					data: $(this).serialize(),
					beforeSend: function(data){
						blockElement($('#employee-form'));
						$('div.error').text('');
						$('input.error').removeClass('error');
					},
					success: function(response){
						if (typeof response.error === 'undefined' || response.error == 1)
						{
							$.jGrowl('Не удалось добавить сотрудника. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

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

						$.jGrowl('Сотрудник добавлен.', { header: 'Сообщение', life: 15000, theme: 'successMessage' });

						$('input[type="text"]').val('');
					}
				}).done(function(response){
					unblockElement($('#employee-form'));
				});

				return false;
			});
		}
	};

$(document).ready(function() {
    employee.init();
});