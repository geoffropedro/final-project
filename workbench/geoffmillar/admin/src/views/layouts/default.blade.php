<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('page_title', 'CMS')</title>
	<!-- Bootstrap core CSS -->
	{{ HTML::style('packages/geoffmillar/admin/css/style.css') }}
	{{ HTML::script('packages/geoffmillar/admin/vendor/ckeditor/ckeditor.js') }}
	{{ HTML::script('packages/geoffmillar/admin/js/script.js') }}
	@yield('header')
</head>

<body>
	@section('top')
	@include('admin::partials.nav')
	@show
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-12 col-md-12 main">
				@section('main')
				@show
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	{{ HTML::script('packages/geoffmillar/admin/js/colour-picker/jscolor.js') }}

	<script>
	CKEDITOR.replace( 'wysiwyg',{
		filebrowserBrowseUrl: "<?php echo asset('packages/geoffmillar/admin/php/browse.php') ?>"
	});
	</script>
	@yield('footer')
</body>
</html>
