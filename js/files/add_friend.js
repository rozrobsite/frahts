var friend =
	{
		initDialogs: function()
		{
			$('#add_friend_dialog').dialog({
				autoOpen: false,
				modal: true,
				width: 400,
				buttons: {
					"Отправить": function() {
						var dialog = $(this);
						$('.error').hide();

						var friend_email = $('#friendEmail').val();
						var friend_text = $('#friendText').val();

						if (!friend_email) {
							$('.error').show();

							return;
						}

						blockElement($('#friendForm'));

						$.post('/partners/addFriend', {
							email: friend_email,
							text: friend_text
						}, function(response) {
							if (typeof response.error === 'undefined')
							{
								$('#errorText').html('Не удалось отправить сообщение Вашему другу. Попробуйте позже.');
								$('#errorText').show();

								return;
							}

							if (response.error == 4)
							{
								$('#errorText').html('Не правильно введен электронный адрес (E-mail).');
								$('#errorText').show();

								return;
							}

							$.jGrowl('Приглашение Вашему другу отправлено. Спасибо.', {
								header: 'Сообщение',
								life: 15000,
								theme: 'successMessage'
							});

							$('.error').hide();
							$('.friendText').val('');

							dialog.dialog("close");

						}).done(function(data) {
							unblockElement($('#friendForm'));
						});
					},
					"Отмена": function() {
						$('.error').hide();
						$('.friendText').val('');

						$(this).dialog("close");
					}
				}
			});

		},
		send: function()
		{
			$('.add-friend').on('click', function(e) {
				$('#add_friend_dialog').dialog('open');
			});
		},
		init: function()
		{
			friend.send();
		}
	}


$(document).ready(function() {
	friend.initDialogs();
	friend.init();
});

