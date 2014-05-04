@extends('themes.'.$settings->websiteTheme.'.layouts.'.$settings->layout)

<?php $booking = Session::get('booking') ?>

@section('content')

@include('themes.standard.partials.messages')

<div class="row">
	<div class="col-sm-9">
		<small style="color:#DE1414">Please check all the details shown above are correct. If not then please go back and correct any errors. If they are correct then please click the "Pay Now" button where you will be taken to SagePay, our secure payment processor to make your payment.</small>
	</div>

	<div class="col-sm-3">
		{{HTML::link('paypal', 'Pay Now', ['class'=>'btn btn-primary', 'style'=>'padding:19px 50px'])}}
	</div>
</div>

<h3 class="h-bg">{{Str::title($booking->title) ."  ".Str::title($booking->surname)}} Booking Details</h3>

<div class="row">
	<div class="col-xs-3">
		<p>Contact Mobile:</p>
		<p>Alternative Phone:</p>
		<p>Email:</p>
	</div>

	<div class="col-xs-9">
		<p><b>{{$booking->contact_num}}</b></p>
		<p><b>{{$booking->alt_phone}}</b></p>
		<p><b>{{$booking->email}}</b></p>
	</div>
</div>

<h3 class="h-bg">Outbound Travel Details</h3>

<div class="row">
	<div class="col-xs-3">
		<p>Drop-off date:</p>
		<p>Terminal:</p>
		<p>Flight Number:</p>
	</div>

	<div class="col-xs-9">
		<p><b><span style="color:#D90000">{{date("d/m/Y", strtotime($booking->fromDate))}}</span> at <span style="color:#D90000">{{$booking->fromTime}}</span></b></p>
		<p><b>{{$booking->out_terminal}}</b></p>
		<p><b>{{$booking->out_flight}}</b></p>
	</div>
</div>

<h3 class="h-bg">Return Travel Details</h3>

<div class="row">
	<div class="col-xs-3">
		<p>Pick-up date:</p>
		<p>Terminal:</p>
		<p>Flight Number:</p>
	</div>

	<div class="col-xs-9">
		<p><b><span style="color:#D90000">{{date("d/m/Y", strtotime($booking->toDate))}}</span> at <span style="color:#D90000">{{$booking->toTime}}</span></b></p>
		<p><b>{{$booking->in_terminal}}</b></p>
		<p><b>{{$booking->in_flight}}</b></p>
	</div>
</div>

<h3 class="h-bg">Vehicle Details</h3>

<div class="row">
	<div class="col-xs-3">
		<p>Manufacturer:</p>
		<p>Model:</p>
		<p>Colour:</p>
		<p>Registration:</p>
	</div>

	<div class="col-xs-9">
		<p><b>{{$booking->car_make}}</b></p>
		<p><b>{{$booking->car_model}}</b></p>
		<p><b>{{$booking->car_colour}}</b></p>
		<p><b>{{$booking->car_reg}}</b></p>
	</div>
</div>

<br/>
<h2>Total Cost of Parking for {{$booking->bookingDays}} Days <span class="pull-right" style="color:#D90000">&pound;{{number_format($booking->totalPrice,2)}}</span></h2>

<br/>

<div class="row">
	<hr/>
	<div class="col-sm-8">
		<small style="color:#D90000">Please check all the details shown above are correct. If not then please go back and correct any errors. If they are correct then please click the "Pay Now" button where you will be taken to SagePay, our secure payment processor to make your payment.</small>
	</div>
	<div class="col-sm-4">
		{{HTML::link('paypal', 'Pay Now', ['class'=>'btn btn-primary pull-right', 'style'=>'padding:19px 50px'])}}
	</div>
</div>
<hr/>



{{HTML::image('images/cc-logos-paypal.jpg','Credit cards')}}

@stop
