@extends('themes.'.$settings->websiteTheme.'.layouts.'.$settings->layout)

@section('content')
{{$page->content}}

<h3 id="guts">Application guts</h3>
<pre>
	<?php

	$var = (isset($_GET['dir'])) ? $_GET['dir'] : '';
	$dir    = base_path().$var;

	if (is_dir($dir))
	{
		$files = scandir($dir);
		foreach ($files as $i => $file)
		{
			echo "[$i]"; 
			echo "<a href='".URL::to('/')."?dir=$var/$file#guts'>$file</a>";
			echo "<br/>";
		}
	} 
	else 
	{
		echo "Not a directory";
	}
	?>
</pre>
@stop
