<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>提交后结果</title>
	<style type="text/css">
		body{
			padding:100px;
			border: solid;
			text-align: center;
		}
	</style>
</head>

<body>
<h1 style="color:red;">提交后结果</h1>
	<?php //读取提交后的数据，通过submit.txt来存储数据
		$myfile = fopen("submit.txt", "r") or die("Unable to open file!");
		echo fread($myfile,filesize("submit.txt"));
		fclose($myfile);
	?>

</body>
</html>
