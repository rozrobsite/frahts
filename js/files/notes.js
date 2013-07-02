$(document).ready(function() {
	//===== Calendar =====//

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var event_start = $('#event_start');
	var event_end = $('#event_end');
	var event_type = $('#event_type');
	var calendar = $('#calendar');
	var form = $('#notesDialog');
	var event_id = $('#event_id');
	var format = "dd.MM.yyyy HH:mm";

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month'
		},
		firstDay: 1,
		editable: false,
		week: 'ddd d/M',
		timeFormat: 'H(:mm)',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','Июнь','Июль','Авг.','Сент.','Окт.','Нояб.','Дек.'],
		dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
		dayNamesShort: ["ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ"],
		buttonText: {
			today: "Сегодня",
			month: "Месяц",
			week: "Неделя",
			day: "День"
		},
		eventSources: [{
			url: '/notes/get',
			type: 'POST',
			data: {
			},
			error: function() {
				$.jGrowl('Ошибка соединения с источником данных!', {
					header: 'Ошибка', 
					life: 15000, 
					theme: 'errorMessage'
				});
			}
		}],
		dayClick: function(date, allDay, jsEvent, view) {
			var newDate = $.fullCalendar.formatDate(date, format);
			event_start.val(newDate);
			event_end.val(newDate);
			formOpen('add');
		},
		eventClick: function(calEvent, jsEvent, view) {
			event_id.val(calEvent.id);
			event_type.val(calEvent.title);
			event_start.val($.fullCalendar.formatDate(calEvent.start, format));
			event_end.val($.fullCalendar.formatDate(calEvent.end, format));
			formOpen('edit');
		}
	});
	
	$('#notesDialog').dialog({
		autoOpen: false,
		width: 400,
		buttons: [{
			id: 'add',
			text: 'Добавить',
			click: function() {
				$.post('/notes/add', {
					start: event_start.val(),
					end: event_end.val(),
					type: event_type.val()
				}, function(response){
					if (typeof response.error === 'undefined' || response.error > 0)
					{
						$.jGrowl('Событие не добавлено. Попробуйте позже.', {
							header: 'Ошибка', 
							life: 15000, 
							theme: 'errorMessage'
						});

						return;
					}
					
					calendar.fullCalendar('renderEvent', {
						id: response.id,
						title: event_type.val(),
						start: response.start,
						end: response.end,
						allDay: false
					});
					
					emptyForm();
					form.dialog('close');
				});
			}
		},
		{
			id: 'edit',
			text: 'Изменить',
			click: function() {
				$.post('/notes/edit', {
					id: event_id.val(),
					start: event_start.val(),
					end: event_end.val(),
					type: event_type.val()
				}, function(response){
					if (typeof response.error === 'undefined' || response.error > 0)
					{
						$.jGrowl('Событие не было изменено. Попробуйте позже.', {
							header: 'Ошибка', 
							life: 15000, 
							theme: 'errorMessage'
						});

						return;
					}
					
					calendar.fullCalendar('refetchEvents');
					
					emptyForm();
					form.dialog('close');
				});
			}
		},
		{
			id: 'delete',
			text: 'Удалить',
			click: function() { 
				$.post('/notes/delete', {
					id: event_id.val()
				}, function(response){
					if (typeof response.error === 'undefined' || response.error > 0)
					{
						$.jGrowl('Событие не было удалено. Попробуйте позже.', {
							header: 'Ошибка', 
							life: 15000, 
							theme: 'errorMessage'
						});

						return;
					}
					
					calendar.fullCalendar('removeEvents', response.id);
					
					emptyForm();
					form.dialog('close');
				});
			}
		},
		{
			id: 'cancel',
			text: 'Отмена',
			click: function() { 
				$(this).dialog('close');
				emptyForm();
			}
		}]
	});
	
	event_start.datetimepicker({
		dateFormat: 'dd.mm.yy'
	});
	event_end.datetimepicker({
		dateFormat: 'dd.mm.yy'
	});
	
	/** функция очистки формы */
	function emptyForm() {
		event_start.val('');
		event_end.val('');
		event_type.val('');
		event_id.val('');
	}
	/* режимы открытия формы */
	function formOpen(mode) {
		if(mode == 'add') {
			/* скрываем кнопки Удалить, Изменить и отображаем Добавить*/
			$('#add').show();
			$('#edit').hide();
			$('#delete').hide();
		}
		else if(mode == 'edit') {
			/* скрываем кнопку Добавить, отображаем Изменить и Удалить*/
			$('#edit').show();
			$('#add').hide();
			$('#delete').show();
		}
		form.dialog('open');
	}
});

