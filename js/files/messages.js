var search = {
	init: function() {
		$('#searchMessageUsers').on('submit', function(e){
			var searchText = $('#searchText').val();
			if (!searchText)
			{
				$.jGrowl('Введите имя или фамилию пользователя.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

				return;
			}

			blockElement($('#users_message'));

			$.post('/user/searchUsers/text', {
				searchText: searchText
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0) {
					unblockElement($('#users_message'));

					return;
				}

				$('#userList').html('');
				$('#userList').html(response.userList);

			}).done(function(data){
				unblockElement($('#users_message'));
			});

			return false;
		});

	},
	sendMessage: function() {
		$(document).on('click', '#sendMessage', function(e){
			var message = $('#enterMessage').val();

			if (!message)
			{
				$.jGrowl('Введите сообщение.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

				return;
			}

			var receiving_id = $('#enterMessage').data('receiving-id');
			var url = location.href;

			blockElement($('.enterMessage'));

			$.post('/messages/add', {
				message: message,
				receiving_id: receiving_id
			}, function(response){
				if (typeof response.error === 'undefined' || response.error > 0)
				{
					$.jGrowl('Сообщение не добавлено. Попробуйте позже.', { header: 'Ошибка', life: 15000, theme: 'errorMessage' });

					unblockElement($('.enterMessage'));

					return;
				}

				$.get(url, function(response){
					$('#usersMessages').html('');
					$('#usersMessages').html($(response).find('#usersMessages'));
				}).done(function(data){
					$('#enterMessage').val('');
					unblockElement($('.enterMessage'));
				});
			});
		});
	},
	update: function() {
		$(document).on('click', '#messagesUpdate', function(e){
			$('#messagesUpdate').hide();
			$('#messagesLoader').show();

			$.get(location.href, function(response){
				$('#usersMessages').html('');
				$('#usersMessages').html($(response).find('#usersMessages'));

				$('#messagesUpdate').show();
				$('#messagesLoader').hide();
			});
		})
	}
};

$(document).ready(function(){
	search.init();
	search.sendMessage();
	search.update();
});