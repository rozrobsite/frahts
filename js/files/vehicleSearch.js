var countryLocationVehicle =
{
	init: function()
	{
		$('#vcoid').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#vcoid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionLocationVehicle').html($response);

				updateSelect.update($('select.regionLocationVehicle'));

				$('#vrid').change();
			});
		});
	}
};

var regionLocationVehicle =
{
	init: function()
	{
		$('#vrid').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#vrid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityLocationVehicle').html($response);

				updateSelect.update($('select.cityLocationVehicle'));
			});
		});
	}
};

var countryFilterVehicle =
{
	init: function()
	{
		$('#fvcoid').on('change', function(e){
			$.post('/location/region', {
				country_id: $('#fvcoid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.regionFilterVehicle').html($response);

				updateSelect.update($('select.regionFilterVehicle'));

				$('#fvrid').change();
			});
		});
	}
};

var regionFilterVehicle =
{
	init: function()
	{
		$('#fvrid').on('change', function(e){
			$.post('/location/city', {
				region_id: $('#fvrid').val()
			}, function(response){
				if(response == null) return;

				$response = $(response).html();
				$('select.cityFilterVehicle').html($response);

				updateSelect.update($('select.cityFilterVehicle'));
			});
		});
	}
};

var timerId;
var autoupdate =
{
	init: function()
	{
		$('#timerButton').on('click', function(e){
			$.post('/settings/autoupdate', {
				autoupdate: $('#autoupdate').val(),
				timer: $(this).data('timer')
			}, function(response){
				if(response == null || response.timer == null) return;

				$('#timerButton').html(response.timer ? 'Стоп' : 'Старт');

				if (response.timer)
				{
//					$('#timerButton').attr('data-timer', 0);
					timerId = setTimeout(function(){location.reload();}, parseInt($('#autoupdate').val()) * 1000);
//					var iNow = new Date().setTime(new Date().getTime() + 5 * 1000); // now plus 5 secs
//					var iEnd = new Date().setTime(new Date().getTime() + parseInt($('#autoupdate').val()) * 1000); // now plus 15 secs
//					$('#progress1').anim_progressbar({start: iNow, finish: iEnd, interval: 1});

				}
				else
				{
					clearTimeout(timerId);
//					$('#timerButton').attr('data-timer', 1);
				}

			});
		});

		$('#timerButton').html($('#timerButton').data('timer') == 1 ? 'Стоп' : 'Старт');
		if ($('#timerButton').data('timer') == 1)
		{
			timerId = setTimeout(function(){location.reload();}, parseInt($('#autoupdate').val()) * 1000);
//			var iNow = new Date().setTime(new Date().getTime() + 5 * 1000); // now plus 5 secs
//			var iEnd = new Date().setTime(new Date().getTime() + parseInt($('#autoupdate').val()) * 1000); // now plus 15 secs
//			$('#progress1').anim_progressbar({start: iNow, finish: iEnd, interval: 1});
		}
	}
}


$(document).ready(function(){
//	$('#vcoid').change();
	countryLocationVehicle.init();
	regionLocationVehicle.init();

//	$('#fvcoid').change();
	countryFilterVehicle.init();
	regionFilterVehicle.init();

//	autoupdate.init();
});