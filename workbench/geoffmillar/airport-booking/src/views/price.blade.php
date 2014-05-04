@extends('airport-booking::layouts.default')

@section('booking-content')


<h1 class="bigText">Booking Price</h1>
<p>Here you can manage the price for parking and add featured.</p><br/>

<div id="pricepanel"></div>

<script type="text/javascript">
Ext.onReady( function() {
	
	var panel = new B2.Price.PriceGridPanel({
		title: 'Price List',
		height: 500,
		renderTo: 'pricepanel',
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