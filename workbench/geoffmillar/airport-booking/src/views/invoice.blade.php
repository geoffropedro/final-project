@extends('airport-booking::layouts.default')

@section('booking-content')

<h1 class="bigText">Booking Invoice</h1>
<p>Here you can search the database of bookings, enter the period that you want to search, it will search on the <b>Transaction Date</b>.</p><br/>

<div id="booking-invoice-grid"></div>
<script type="text/javascript">
Ext.onReady(function(){
	Ext.QuickTips.init();

	var panel = new B2.Booking.BookingInvoiceGrid({
		title: 'Booking Invoice',
		height: 500,
		renderTo: 'booking-invoice-grid',
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
