<?php
$path = 'C:\xampp\htdocs\final-project\airport-operator-v7\public/images/';
$url = 'http://localhost/final-project/airport-operator-v7/public/images/';

//Available directories
$directories = ['uploads','slider'];
$files = array();

//Scan each directory and add to files array
foreach ($directories as $directory){
	$scan = scandir($path.$directory);
	foreach($scan as $file)
	{
		if (!is_dir($file))
		{
			$files[] = $directory."/".$file;
		}
	}
}
?>

<html>
<body>
	<head>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
		<style>
		.thumbnail 	{height: 268px; text-align: center;}
		body 		{padding:10px;}
		</style>
	</head>

	<?php
	if(count($files)) 
	{
		//Display each image from array
		foreach($files as $file) 
		{
			?>
			<div class="col-xs-3">
				<div class="thumbnail">
					<div class="caption">
						<img src="<?php echo $url.$file; ?>" class="img-responsive" style="max-height:170px; margin:0 auto">
						<h6><?= $file ?></h6>
						<?php echo '<a class="btn btn-primary" onclick="window.opener.CKEDITOR.tools.callFunction('.$_GET['CKEditorFuncNum'].',\''.$url.$file.'\'); window.close();" href="#">Select image</a><br />'; ?>
					</div>
				</div>
			</div>

			<?php
		}
	} 
	else 
	{
		echo 'No files available. Please use the upload feature if available.';
	}
	?>
	</body>
	</html>
	