@extends ('admin::layouts.default')

@section('header')

<style>
.icons {
	margin-bottom: 30px;
}
.icons a {
	color: #333;
	display: inline-block;
	width: 100px;
	height: 100px;
	border: 1px solid #CCCCCC;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;
	text-align: center;
	font-size: 12px;
	background-image: -webkit-gradient(radial,center center,0,center center,460,from(#FFFFFF),to(#F2EDED));
	background-image: -webkit-radial-gradient(circle,#FFFFFF,#F2EDED);
	background-image: -moz-radial-gradient(circle,#FFFFFF,#F2EDED);
	background-image: radial-gradient(circle,#FFFFFF,#F2EDED);
	background-repeat: no-repeat;
	margin: 0 3px 7px 0;
}
.icons a:hover {
	background: white;
	color: #57A000;
}
.icons img {
	margin: 20px 0 10px 0;
}

</style>

@stop

@section('main')
@parent
<div class="jumbotron">
	<h1>Admin control panel</h1>
</div>


<div class="well">
	<p>Welcome  {{Str::title(Auth::user()->username)}}, You have successfully loggedin to the administration control panel</p>

	<hr>

	<div class="row icons">
		<div class="col-xs-12">
			<a target="_blank" href="{{URL::to('/')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/home.png','')}}<br/>Site homepage</a>
			<a href="{{URL::to('admin/bookings/schedule')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/clipboard.png','')}}<br/>Bookings</a>

			@if (Auth::user()->auth != 'User')
			<a href="{{URL::to('admin/settings')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/service.png','')}}<br/>Settings</a>	
			<a href="{{URL::to('admin/pages/create')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/edit.png','')}}<br/>Create page</a>
			<a href="{{URL::to('admin/media/create')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/photo.png','')}}<br/>Upload image</a>
			<a href="{{URL::to('admin/themes')}}">{{HTML::image('packages/geoffmillar/admin/images/icons/app.png','')}}<br/>Themes</a>
			@endif
		</div>
	</div>

	<a class="btn btn-primary" href="{{URL::to('/')}}/admin/logout"><i class="fa fa-sign-out"></i> Log Out</a>

</div>
@stop