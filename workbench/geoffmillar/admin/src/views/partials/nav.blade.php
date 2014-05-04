<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{HTML::link('admin','Admin',['class'=>'navbar-brand','style'=>'margin-right:10px'])}}
		</div>

		<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-left">
				<li class="active"><a href="{{URL::to('/admin')}}"><i class="fa fa-home"></i> Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i>Content <b class="caret"></b></a>
					<ul class="dropdown-menu">
						@foreach ($contentmenu->getAttributes() as $item => $link)
						<li>{{ link_to($link, $item) }}</li>
						@endforeach
					</ul>
				</li>
				<li><a href="{{URL::to('/admin/settings')}}"><i class="fa fa-cogs"></i> Settings</a></li>
				<li><a href="{{URL::to('/admin/users')}}"><i class="fa fa-user"></i> Users</a></li>

				@foreach ($menu->getAttributes() as $item => $link)
				<li><a href="{{URL::to($link['route'])}}"><i class="{{$link['icon']}}"></i> {{$item}}</a></li>
				@endforeach

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i>Logged in as {{ $user->name }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to('/')}}/admin/users/{{ $user->id }}/edit"><i class="fa fa-wrench"></i> Edit Profile</a></li>
						<li><a href="{{URL::to('/')}}" target="_blank"><i class="fa fa-desktop"></i> View Website</a></li>
						<li class="divider"></li>
						<li><a href="{{URL::to('/')}}/admin/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
