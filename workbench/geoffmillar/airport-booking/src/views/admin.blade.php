@extends('airport-booking::layouts.default')

@section('booking-content')


<h1 class="bigText">Booking Admin</h1>
<p>Here you can manage and edit bookings.</p><br/>


<div id="bookingpanel"></div>
<script type="text/javascript">
Ext.onReady( function() {
	
	Ext.QuickTips.init();
	
	var panel = new B2.Booking.BookingListPanel({
		title: 'Booking List',
		height: 500,
		renderTo: 'bookingpanel',
		collapsible: true
	});

	Ext.EventManager.onWindowResize(resizeGrid);
	function resizeGrid()
	{
		panel.doLayout();
	}
	
});
</script>



@stop