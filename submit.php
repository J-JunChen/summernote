<?php
 	date_default_timezone_set('PRC');  //获取中国时区，'PRC':中华人民共和国

	$content = $_POST['content']; //获取文本框值

	$myfile = fopen("submit.txt", "w") or die("Unable to open file!");
	
	fwrite($myfile, $content);
	fclose($myfile);

?>