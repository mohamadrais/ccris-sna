<?php
define('CALENDAR_PATH', 'calendar/');

include("defaultLang.php");
include("language.php");
include("lib.php");
$x = new DataList;
$x->TableTitle = 'Calendar';
include("header.php");

// include(CALENDAR_PATH . 'container.php');

// $sql = "SELECT id, title, start, end, color FROM events ";
// $events = sql($sql,$eo);

?>
<link rel="stylesheet" href="<?php echo CALENDAR_PATH; ?>css/calendar.css">
<link rel="stylesheet" href="assets/plugins/calendar/dist/fullcalendar.css">
<link rel="stylesheet" href="assets/css/style.css">

<div class="page-wrapper ps ps--theme_default">
<div class="container-fluid">	
	<div class="card">
		<div class="card-body">
	<!-- <h2>Event Calendar with jQuery, PHP and MySQL</h2>	 -->
	<div class="page-header">
		<div class="fc-toolbar fc-header-toolbar">
			<div class="fc-left btn-group">
				<button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" data-calendar-nav="prev"><span class="fc-icon fc-icon-left-single-arrow"></span></button>
				<button type="button" class="btn fc-button fc-state-default" data-calendar-nav="today">Today</button>
				<button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" data-calendar-nav="next"><span class="fc-icon fc-icon-right-single-arrow"></span></button>
			</div>
			<div class="fc-center"><h3></h3></div>
			<div class="fc-right btn-group">
				<button type="button" class="btn fc-button fc-state-default fc-corner-left" data-calendar-view="year">Year</button>
				<button type="button" class="btn fc-button fc-state-default active" data-calendar-view="month">Month</button>
				<button type="button" class="btn fc-button fc-state-default" data-calendar-view="week">Week</button>
				<button type="button" class="btn fc-button fc-state-default fc-corner-right" data-calendar-view="day">Day</button>
			</div>
		</div>
	</div>
	<div id="showEventCalendar"></div>
	</div>
	</div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="<?php echo CALENDAR_PATH; ?>js/calendar.js"></script>
<script type="text/javascript" src="<?php echo CALENDAR_PATH; ?>js/events.js"></script>
<!-- <script type="text/javascript" src="assets/plugins/calendar/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="assets/plugins/calendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript" src="assets/plugins/calendar/dist/cal-init.js"></script>
<?php include('footer.php');?>
