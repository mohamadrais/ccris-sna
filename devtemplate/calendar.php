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


<div class="container" style="margin-top: 180px">	
	<!-- <h2>Event Calendar with jQuery, PHP and MySQL</h2>	 -->
	<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
				<button class="btn btn-default" data-calendar-nav="today">Today</button>
				<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-default" data-calendar-view="year">Year</button>
				<button class="btn btn-default" data-calendar-view="month">Month</button>
				<button class="btn btn-default active" data-calendar-view="week">Week</button>
				<button class="btn btn-default" data-calendar-view="day">Day</button>
			</div>
		</div>
		<h3></h3>
	</div>
	<div class="row">
		<!-- <div class="col-md-9"> -->
		<div class="col-md-12">
			<div id="showEventCalendar"></div>
		</div>
		<!-- <div class="col-md-3">
			<h4>All Events List</h4>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div> -->
	</div>	

</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="<?php echo CALENDAR_PATH; ?>js/calendar.js"></script>
<script type="text/javascript" src="<?php echo CALENDAR_PATH; ?>js/events.js"></script>
<?php include('footer.php');?>
