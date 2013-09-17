var timeout;
var iterval = 60000;
var countMails = 0;
var percent = 0;
var emails = [];
var subject = '';
var text = '';
var countAllEmails = 0;

var mailing = {
	updateVehicle: function() {
		$('#updateVehicle').on('click', function(e){
			$('#updateVehicle').hide();
			$('#updateVehicleViewProgress').show();

			$.post('/admin/mailing/setCronMailingDate',{
				cron_mailing_type: 1
			}, function(response){
				$('#lastStartUpdateVehicle').html(response.startDate);

				updateVehicleRequest();
				timeout = setInterval('updateVehicleRequest()', iterval);
			});
		});
	},
	addUsers: function(type, text) {
		$('#loadingUsers').show();

		$.post('/admin/users/addAll', {
			type: type
		}, function(response){
			if (typeof response.users !== 'undefined') {
				$('#countUsers').html(response.count);
				$('#emails').val('');
				$('#emails').val(response.users);
				$('#searchTextUsers').html('(' + text + ')');
			}

			$('#loadingUsers').hide();
		});
	},
	sendInputtedEmails: function() {
		$('#sendingButton').on('click', function(e){
			$('#sendingButton').hide();

			emails = $('#emails').val().split("\n");
			countAllEmails = emails.length;
			subject = $('#subject').val();
			text = $('#text').val();

			if (!emails.length || !subject || !text) {
				alert('Ошибка. Проверьте есть ли данные: список E-mail, "Тема рассылки", "Текст рассылки"');

				return;
			}

			$('#viewProgress').show();

			sendedInputtedEmails();
			timeout = setInterval('sendedInputtedEmails()', iterval);
		});
	},
	init: function() {
		mailing.updateVehicle();
		mailing.sendInputtedEmails();
	}
}

$(document).ready(function(){
	mailing.init();
});

function updateVehicleRequest() {
	$('#updateVehicleAction').html('Отправка');
	$('#updateVehicleProgress .bar').width(percent + '%');

	$.post('/admin/mailing/cronMailing', {
		cron_mailing_type: 1
	}, function(response){
		if (typeof response.stop !== 'undefined' && response.stop) {
			clearInterval(timeout);

			$('#updateVehicleAction').html('<span style="color:green">Отправка закончена</span>');
		}

		countMails += response.count;
		percent = countMails / response.vehiclesCount * 100;
		percent = Math.round(percent);

		$('#updateVehicleProgress .bar').width(percent + '%');
		$('#updateVehicleSended').html(countMails);
		$('#updateVehicleSendedPercent').html(percent);
		$('#updateVehicleAll').html(response.vehiclesCount);
	});
}

function sendedInputtedEmails() {
	var sendedEmails = [];
	for (var i = 0; i < 4 ; i++) {
		if (emails.length)
			sendedEmails.push(emails.shift());
	}

	if (!sendedEmails.length) {
		clearInterval(timeout);

		$('#sendedAction').html('<span style="color:green">Отправка закончена</span>');

		return;
	}

	$('#sendedAction').html('Отправка');
	$('#sendedProgress .bar').width(percent + '%');

	$.post('/admin/mailing/inputtedMail', {
		emails: sendedEmails,
		subject: subject,
		text: text
	}, function(response){
		if (typeof response.stop !== 'undefined' && response.stop) {
			clearInterval(timeout);

			$('#sendedAction').html('<span style="color:red">Ошибка. Возможные причины: список e-mail для рассылки пуст, не введены тема и/или текст рассылки.</span>');

			return;
		}

		countMails += sendedEmails.length;
		percent = countMails / countAllEmails * 100;
		percent = Math.round(percent);

		$('#sendedProgress .bar').width(percent + '%');
		$('#sended').html(countMails);
		$('#sendedPercent').html(percent);
		$('#sendedAll').html(countAllEmails);

		$('#emails').val('');
		$('#emails').val(emails.join("\r\n"));
	});
}