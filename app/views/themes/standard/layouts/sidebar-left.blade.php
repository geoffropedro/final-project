<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" user-scalable="no">
	<title>{{$page->metatitle}}</title>
	<meta name="description" content="{{$page->metadescription}}">
	{{ HTML::style('css/style.min.css'); }}
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!--[if lte IE 8]><script src="{{ asset('js/polyfill.min.js') }}"></script><![endif]-->
</head>
<body>
<!--[if lt IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
	<div class="container pageWrap">
		<div class="header">
			<div class="row">
				<div class="col-sm-6 site-title">
					{{$settings->company}}
				</div> 

				<div class="col-sm-6" style="margin-top:20px">
					<ul class="list-unstyled list-inline pull-right">
						<li style="border-right: 1px solid #C0C0C0; padding-right:10px"><i class="fa fa-envelope"></i> {{$settings->email}}</li>
						<li><i class="fa fa-user"></i> {{$settings->telephone}}</li>
					</ul>
				</div>
			</div>
		</div>

		@include('themes.standard.partials.nav')

		@if(count($slider) > 0)
		<div id="main-slider" class="carousel slide hidden-xs" data-ride="carousel">
			<ol class="carousel-indicators" style="position:absolute; bottom:0">
				<?php $count = 0; ?>
				@foreach($slider as $slide)
				<li data-target="#main-slider" data-slide-to="<?= $count; ?>" class="<?= ($count == 0) ? 'active' : ''; ?>"></li>
				<?php $count++; ?>
				@endforeach
			</ol>

			<div class="carousel-inner" style="max-height:300px">
				<?php $count = 0; ?>
				@foreach($slider as $slide)
				<div class="item <?= ($count == 0) ? 'active' : ''; ?>">
					{{HTML::image('images/slider/'.$slide->image, $slide->title , ['class'=>'img-responsive','style'=>'min-width:1084px'])}}
					@if($slide->content)
					<div class="carousel-caption">
						{{$slide->content}}
					</div>
					@endif
				</div>

				<?php $count++; ?>
				@endforeach
			</div>
			<a class="left carousel-control" href="#main-slider" data-slide="prev"></a>
			<a class="right carousel-control" href="#main-slider" data-slide="next"></a>
		</div>
		@endif

				@include('themes.standard.partials.quote-form')


		<div class="row">
			<div class="col-sm-4">
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('call-me-back')}}
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('find-us')}}
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('what-others-say')}}
			</div>

			<div class="col-sm-8">
				@yield('content')
			</div>
		</div>
	</div>

	<div class="container">
		<div class="footer-tier-1 full-width">
			<div class="col-md-4">
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('contact-details')}}
			</div>

			<div class="col-md-4">
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('tag-cloud')}}
			</div>

			<div class="col-md-4">
				{{GeoffMillar\ContentBlock\Models\Block::getBlock('reviews')}}
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="footer-tier-2 full-width">
			&copy; Copyright {{$settings->company}} 2014 - All rights reserved site - development by Pixperfect - Airport Parking web systems to rent. 
		</div>
	</div>
	{{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>
