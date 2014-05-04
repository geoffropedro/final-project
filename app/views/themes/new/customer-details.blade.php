@extends('themes.'.$settings->websiteTheme.'.layouts.'.$settings->layout)

@section('content')

@include('themes.standard.partials.messages')

{{$page->content}}

{{Form::open(array('url' => '/customer-details', 'class'=>'form-horizontal'))}}

{{---------------------------
Name & Address Details
----------------------------}}

<h3 class="h-bg">Name &amp; Address Details</h3>

<div class="form-group">
	{{Form::label('title', 'Title *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::select('title', ['0' => 'Select', 'mr' => 'Mr', 'mrs'=>'Mrs', 'miss'=>'Miss', 'ms'=>'Ms', 'dr'=>'Dr'] , null, ['class'=>'form-control'] );}}
	</div>
</div>

<div class="form-group">
	{{Form::label('firstname', 'Firstname *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('firstname', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('surname', 'Surname *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('surname', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('address_line1', 'Address Line 1 *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('address_line1', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('address_line2', 'Address Line 2 *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('address_line2', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('post_town', 'Post town *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('post_town', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('post_code', 'Post code *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('postcode', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('country', 'Country *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::select('country', Toolkit::countriesArr() , null, ['class'=>'form-control'] );}}
	</div>
</div>
<br/>


{{---------------------------
Contact Details
----------------------------}}

<h3 class="h-bg">Contact Details</h3>

<div class="form-group">
	{{Form::label('contact_num', 'Contact Mobile *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('contact_num', null, ['class'=>'form-control'])}}
		<small>Please ensure that you are contactable on this number, as communication is via mobile phone throughout the service.</small>
	</div>
</div>

<div class="form-group">
	{{Form::label('alt_phone', 'Alternative Phone *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('alt_phone', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('email', 'Email *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::email('email', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('confirm_email', 'Confirm Email *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::email('confirm_email', null, ['class'=>'form-control'])}}
		<small>This is where confirmation instructions will be sent when booking is completed.</small>
	</div>
</div>
<br/>

{{---------------------------
Vehicle Details
----------------------------}}

<h3 class="h-bg">Vehicle Details</h3>


<div class="form-group">
	{{Form::label('car_make', 'Make *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('car_make', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('car_model', 'Model *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('car_model', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('car_olour', 'Colour *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('car_colour', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('car_reg', 'Registration *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('car_reg', null, ['class'=>'form-control'])}}
	</div>
</div>
<br/>

{{---------------------------
Travel Details
----------------------------}}

<h3 class="h-bg">Travel Details</h3>
<h3 class="h-bg" style="background:#6ACFFF">DEPARTURE (Leaving the UK)</h3>

<div class="form-group">
	{{Form::label('out_flight', 'Flight number *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('out_flight', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('out_terminal', 'Terminal *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::select('out_terminal', [ 0 => 'Select', 1 => '1', 2=>'2', 3=>'3', 4=>'4', 5 =>'5'] , null, ['class'=>'form-control'] );}}
	</div>
</div>

<h3 class="h-bg" style="background:#6ACFFF">RETURN (Arriving in the UK)</h3>

<div class="form-group">
	{{Form::label('in_flight', 'Flight number *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::text('in_flight', null, ['class'=>'form-control'])}}
	</div>
</div>

<div class="form-group">
	{{Form::label('in_terminal', 'Terminal *', array('class' => 'col-sm-3 control-label'))}}
	<div class="col-sm-9">
		{{Form::select('in_terminal', [ 0 => 'Select', 1 => '1', 2=>'2', 3=>'3', 4=>'4', 5 =>'5'] , null, ['class'=>'form-control'] );}}

		<br/>
		<p>{{Form::checkbox('confirmation', 'value', false)}} I confirm I have read and understood the {{HTML::link('terms-and-conditions','Terms &amp; Conditions' , ['target'=>'_blank'])}} *</p>
		<p style="font-size:10px">By ticking "I confirm I have read and understood the Terms &amp; Conditions" you agree to these terms and conditions. By completing and submitting the following electronic order form you are making an offer to purchase goods/services which, if accepted by us, will result in a binding contract.</p>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-9 col-sm-offset-3">
		<div class="pull-right">
			{{HTML::link('/','Cancel', ['class'=>'btn btn-danger'])}}
			{{Form::submit('Book Parking &amp; Pay Online' , ['class'=>'btn btn-success' , 'style'=>'margin-left:5px'])}}
		</div>
	</div>
</div>

{{Form::close()}}

@stop
