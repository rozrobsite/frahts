var timeout;
var iterval = 60000;
var countMails = 0;
var percent = 0;

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
	init: function() {
		mailing.updateVehicle();
//		mailing.addAllUsers();
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