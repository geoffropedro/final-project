@extends('admin::layouts.default')

@section('main')
@parent
@include('admin::partials.new')
<h1>{{ $modelName }}</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			@if (isset($columns[0]))
			@foreach ($columns[0] as $name => $value)
			<td><b>{{ $name }}</b></td>
			@endforeach
			@endif
		</thead>

		@foreach ($instances as $i => $model)
		<tr>
			@foreach ($columns[$i] as $name => $value)
			<td>{{ $value }}</td>
			@endforeach
			<td class="no-wrap" width="160">
				{{ Form::model($model, array('action' => array($controller . '@destroy', $model->id), 'method' => 'DELETE')) }}
			
				@if (Auth::user()->auth != 'User' && $editable)
				<button class="btn btn-danger btn-sm pull-right" type="submit" onclick="return confirmDelete()"><i class="fa fa-minus-square"></i> Delete</button>
				@endif
				{{ Form::close() }}

				<?php (Auth::user()->auth == 'User' && Auth::user()->name != $model->name) ? $hide = 'hide' : $hide = '' ;  ?>
				<a style="margin-right:5px" href="{{ URL::action($controller . '@edit', array($model->id)) }}" class="btn btn-primary btn-sm pull-right {{$hide}}" type="submit">
					<i class="fa fa-pencil"></i>Edit
				</a>
			</td>
		</tr>
		@endforeach 
	</table>
</div>
@include('admin::partials.new')
@stop
