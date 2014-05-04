@extends('airport-booking::layouts.default')

@section('booking-content')

<h1 class="bigText">Blocked Dates</h1>
<p>Here you can block dates to stop parking being booked</p><br/>

<div id="datepanel"></div>

<script type="text/javascript">
Ext.onReady( function() {
	
	Ext.QuickTips.init();
	
	var panel = new B2.Booking.BlockedDateGridPanel({
		title: 'Blocked Dates List',
		height: 500,
		renderTo: 'datepanel',
		collapsible: true
	});

	Ext.EventManager.onWindowResize(resizeGrid);
	function resizeGrid()
	{
		panel.getView().refresh();
	}
	
});
</script>


@stop