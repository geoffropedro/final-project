@if (Auth::user()->auth != 'User' && $editable)
<a class="btn btn-success pull-right" type="submit" href="{{ action($controller . '@create') }}"><i class="fa fa-plus-square"></i>New {{ $modelName }}</a>
@endif