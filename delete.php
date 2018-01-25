<?php

	$imgSrc =$_POST['imgSrc'];
    if(file_exists($imgSrc)) //
    {
    	if(unlink($imgSrc))
		  echo "图片删除成功！";  //php删除文件函数unlink();
		else
			echo "删除不成功！";
	}
	else
		echo "delete操作失败！";

?>