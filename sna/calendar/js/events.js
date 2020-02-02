(function($j) {
	"use strict";
	var options = {
		events_source: 'calendar/event.php',
		view: 'month',
		tmpl_path: 'calendar/tmpls/',
		tmpl_cache: false,
		// day: new Date().toJSON().slice(0,10),
		day: moment($j.ajax({async: false}).getResponseHeader( 'Date' )).tz("Asia/Kuala_Lumpur").format('YYYY-MM-DD'),
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $j('#eventlist');
			list.html('');

			$j.each(events, function(key, val) {
				$j(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$j('.page-header h3').text(this.getTitle());
			$j('.btn-group button').removeClass('active');
			$j('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};
	var calendar = $j('#showEventCalendar').calendar(options);
	$j('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $j(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});
	$j('.btn-group button[data-calendar-view]').each(function() {
		var $this = $j(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});
	$j('#first_day').change(function(){
		var value = $j(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});
	$j('#language').change(function(){
		calendar.setLanguage($j(this).val());
		calendar.view();
	});
	$j('#events-in-modal').change(function(){
		var val = $j(this).is(':checked') ? $j(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$j('#format-12-hours').change(function(){
		var val = $j(this).is(':checked') ? true : false;
		calendar.setOptions({format12: val});
		calendar.view();
	});
	$j('#show_wbn').change(function(){
		var val = $j(this).is(':checked') ? true : false;
		calendar.setOptions({display_week_numbers: val});
		calendar.view();
	});
	$j('#show_wb').change(function(){
		var val = $j(this).is(':checked') ? true : false;
		calendar.setOptions({weekbox: val});
		calendar.view();
	});	
}(jQuery));
