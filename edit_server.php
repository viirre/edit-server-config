<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit server config by Adaptive Media</title>
</head>
<body>
	<h1>Edit server config by Adaptive Media</h1>
	
	<?php

	$dir = "/etc/nginx/sites-enabled";
	//$dir = '/Users/viirre/Websites/tests/capify-test';

	$dh  = opendir($dir);
	while (false !== ($filename = readdir($dh))) {
	    $files[] = $filename;
	}
	?>
	<form method="get">
		<label>Välj fil att redigera</label>
		<select name="file">
			<option>Välj</option>
			<option disabled>-------</option>
			<?php foreach($files as $file): ?>
				<option value="<?php echo $file; ?>"><?php echo $file; ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit">Ändra fil</button>
	<br><br>
	</form>


	<?php if(isset($_POST['save'])): 

		// SAVE FILE
		$content = $_POST['content'];
		$path = $_POST['file'];

		file_put_contents($path, $content);
		echo 'SPARAT!';

	endif; ?>


	<?php if(isset($_GET['file'])): 
		
		// Get content	
		$path = $dir . '/' . $_GET['file'];
		$content = file_get_contents($path);
		if(! $content) die('Could not load file content');
		?>

		<script src="js/codemirror/codemirror.js"></script>
		<link rel="stylesheet" href="js/codemirror/codemirror.css">
		<script src="js/codemirror/javascript.js"></script>
		<script>
		window.onload = function() {
			var textarea = document.getElementById("html");
			var myCodeMirror = CodeMirror.fromTextArea(textarea, { lineWrapping: true, indentUnit: 4, lineNumbers:true, viewportMargin: Infinity });
		}
		</script>

		<form method="post">
			<input type="hidden" name="file" value="<?php echo $path; ?>">
			<textarea id="html" name="content" style="width:100%;" rows="60"><?php echo $content; ?></textarea>
			<br>
			<button type="submit" name="save">Spara fil</button>
		</form>
	<?php endif; ?>


</body>
</html>