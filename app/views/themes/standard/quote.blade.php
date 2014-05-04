@extends('themes.'.$settings->websiteTheme.'.layouts.'.$settings->layout)

@section('content')

@include('themes.standard.partials.messages')

@if($errors->any())
<p>Try adjusting your booking details and clicking the QUOTE button again.</p>
<p>If you are still having problems using the site then please call {{$settings->company}} Parks on:</p>
<h3><i class="fa fa-phone"></i> {{$settings->telephone}}</h3>
@endif

@if(Session::has('booking'))

{{$page->content}}

<?php $booking = Session::get('booking');?>
<h3>Total number of parking days = {{$booking->bookingDays}}</h3>

<h3 class="h-bg" style="background:#6ACFFF;">DEPARTURE DETAILS</h3>
<p>Date and time you want to be met (not your planes take off time)</p>
<b>Departing</b> - <span style="color:#D90000"> {{date('D, jS M Y',strtotime($booking->fromDate))}} at {{$booking->fromTime}}</span>
<br/><br/>

<h3 class="h-bg">RETURN DETAILS</h3>
<p>Date and time your flight lands back in the UK (not your take off time)</p>
<b>Departing</b> - <span style="color:#D90000"> {{date('D, jS M Y',strtotime($booking->toDate))}} at {{$booking->toTime}}</span>
<br/><br/>

<h3 class="h-bg" style="background:#CCCCCC;">PRICE DETAILS</h3>
<h3>Parking for {{$booking->bookingDays}} Days <span class="pull-right" style="color:#D90000">&pound;{{number_format($booking->totalPrice,2)}}</span></h3>

<div class="pull-right">
{{ HTML::link ('/','Cancel', ['class'=>'btn btn-danger'])}}
{{ HTML::link ('/customer-details','Book Now', ['class'=>'btn btn-success', 'style'=>'width:150px; margin-left:5px'])}}
</div>

@endif

@stop
