var timeout;
var iterval = 3000;

var mailing = {
	updateVehicle: function() {
		$('#updateVehicle').on('click', function(e){
			timeout = setInterval('updateVehicleRequest()', iterval);
		});
	},
	init: function() {
		mailing.updateVehicle();
	}
}

$(document).ready(function(){
	mailing.init();
});

function updateVehicleRequest() {
//	clearTimeout(timeout);
	$.post('/admin/mailing/cronMailing', {cron_mailing_type: 1}, function(response){
		if (response.count > 40) {
			iterval = 0;
			clearTimeout(timeout);
		}

	});
}