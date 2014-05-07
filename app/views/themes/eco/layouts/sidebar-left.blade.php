<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" user-scalable="no">
	<title>{{$page->metatitle}}</title>
	<meta name="description" content="{{$page->metadescription}}">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	{{ HTML::style('css/new-theme-style.css'); }}
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<!--[if lte IE 8]><script src="{{ asset('js/polyfill.min.js') }}"></script><![endif]-->
	<!--[if lt IE 8]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>

<body>
	<div class="container glow no-pad">
		<div class="header">
			<span class="title pull-right">{{$settings->company}}</span>
		</div>

		<div class="main">

		<div class="col-sm-3">
				<br/>
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('side-bar')}}
				<p class="youtubeTitle">Traveling to Gatwick's South Terminal</p>
				<object width="200" height="178"><param name="movie" value="http://www.youtube.com/v/XfNFvKdHuDI?version=3&amp;hl=en_GB&showinfo=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/XfNFvKdHuDI?version=3&amp;hl=en_GB&showinfo=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="178"></embed></object>

				<p style="margin-top:10px; padding-top:20px; border-top:1px dotted grey; width:200px" class="youtubeTitle">Traveling to Gatwick's North Terminal</p>
				<object width="200" height="178"><param name="movie" value="http://www.youtube.com/v/W2KK6jPoAE4?version=3&amp;hl=en_GB&showinfo=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/W2KK6jPoAE4?version=3&amp;hl=en_GB&showinfo=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="178"></embed></object>
			</div>

			<div class="col-sm-6" style="padding-bottom:20px">
				<br/>
				<div class="well">
					@include('themes.standard.partials.quote-form')
				</div>

				@yield('content')
			</div>


				<div class="col-sm-3 col-left no-pad" style="margin-top:20px">
				<span class="col-left-title">parking links {{HTML::image('images/leafQL.png','leaf')}}</span>

				<ul class="list-unstyled pad main-nav">
					@foreach($navigation as $item)
					@if ($item->navigation == 'main')
					<li>{{HTML::image('images/leafLI.jpg','leaf small')}}{{HTML::link($item->slug, $item->title)}}</li>
					@endif
					@endforeach
				</ul>

				<ul class="list-unstyled pad main-nav">
					@foreach($navigation as $item)
					@if ($item->navigation == 'dropdown')
					<li>{{HTML::image('images/leafLI.jpg','leaf small')}}{{HTML::link($item->slug, $item->title)}}</li>
					@endif
					@endforeach
				</ul>

				<div class="pad">					
					<br/>
					<p style="font-size:20px" class="green"><i class="fa fa-phone-square"></i>  <span class="os-semi">{{$settings->telephone}}</span></p>
				</div>

				<div class="text-center"><br/>
					{{GeoffMillar\ContentBlock\Models\Block::getBlock('logos')}}
					<br/>
				</div>
			</div>

			
			<div class="clearfix"></div>
		</div>


		<div class="footer">

			{{$settings->company}}

			<div class="pull-right">
				<i class="fa fa-envelope"></i><a href="mailto:{{$settings->email}}">Email us</a>
				<i style="margin-left:10px" class="fa fa-phone"></i>{{$settings->telephone}}
			</div>

			<br/><br/>
			<div>&copy; Copyright {{$settings->company}} 2014 - All rights reserved site - development by Pixperfect - Airport Parking web systems to rent. </div>
		</div>
	</div>
	{{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>
