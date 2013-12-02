var employee =
{
	add: function()
	{
		$('#employee-form').on('submit', function(e){
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
						$.jGrowl('Не удалось добавить сотрудника. Попробуйте позже.', {
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

					$.jGrowl('Сотрудник добавлен.', {
						header: 'Сообщение',
						life: 15000,
						theme: 'successMessage'
					});

					$('input[type="text"]').val('');

					if (typeof response.employee !== 'undefined' && response.employee)
					{
						$('#employees').html(response.employee);

						employee.update();
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
		$('.jokerEmployeeUpdate').on('click', function(e){
			var employeeId = $(this).data('id');

			$.ajax({
				type: 'post',
				url: '/joker/user/employeeUpdate',
				data: {
					id: employeeId,
					fio: $('#employee_fio_' + employeeId).val(),
					position: $('#employee_position_' + employeeId).val(),
					mobile: $('#employee_mobile_' + employeeId).val(),
					email: $('#employee_email_' + employeeId).val()
				},
				beforeSend: function(data){
					blockElement($('#employees'));
					$('div.error').text('');
					$('input.error').removeClass('error');
				},
				success: function(response){
					if (typeof response.error === 'undefined' || response.error == 1)
					{
						$.jGrowl('Не удалось изменить данные о сотруднике. Попробуйте позже.', {
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
							$('#error_employee_' + fieldName + '_' + employeeId).html(errorText);
							$('#employee_' + fieldName + '_' + employeeId).addClass('error');
						});

						return;
					}

					$.jGrowl('Данные о сотруднике изменены.', {
						header: 'Сообщение',
						life: 15000,
						theme: 'successMessage'
					});

					if (typeof response.employee !== 'undefined' && response.employee)
					{
						$('#employees').html(response.employee);

						employee.update();
					}
				}
			}).done(function(response){
				unblockElement($('#employees'));
			});
		});
	},
	remove: function()
	{
		$('.jokerEmployeeDelete').on('click', function(){
			$('#confirm_dialog').data('employeeId', $(this).data('id')).dialog('open');
		});
	},
	init: function()
	{
		employee.add();
		employee.update();
		employee.remove();
	}
};

var employeeDialog =
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
					var employeeId = dialog.data('employeeId');

					$.ajax({
						type: 'post',
						url: '/joker/user/employeeDelete',
						data: {
							id: employeeId
						},
						beforeSend: function(data){
							blockElement($('#employees'));
						},
						success: function(response){
							if (typeof response.error === 'undefined' || response.error > 0)
							{
								$.jGrowl('Не удалось удалить сотрудника. Попробуйте позже.', {
									header: 'Ошибка',
									life: 15000,
									theme: 'errorMessage'
								});

								return;
							}

							$.jGrowl('Сотрудник удален.', {
								header: 'Сообщение',
								life: 15000,
								theme: 'successMessage'
							});

							$('tr.employee_' + employeeId).remove();

							dialog.dialog('close');
						}
					}).done(function(response){
						unblockElement($('#employees'));
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
	employeeDialog.init();
	employee.init();

});