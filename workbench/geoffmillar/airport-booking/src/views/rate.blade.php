@extends('airport-booking::layouts.default')

@section('booking-content')

<h1 class="bigText">Rate Card</h1>
<p>Here you can set the rate for parking.</p><br/>


<div id="ratepanel"></div>

<script type="text/javascript">
Ext.onReady( function() {

	Ext.QuickTips.init();
	
	var panel = new B2.RateCard.RateCardGrid({
		title: 'Rate Cards',
		height: 500,
		renderTo: 'ratepanel',
		collapsible: true
	});

	// check if window is resized and refresh this grid
	Ext.EventManager.onWindowResize(resizeGrid);
	function resizeGrid()
	{
		panel.getView().refresh();
	}
});
</script>


@stop