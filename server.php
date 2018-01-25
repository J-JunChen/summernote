<?php
    date_default_timezone_set('PRC');  //获取中国时区，'PRC':中华人民共和国

    if(!file_exists(date("Ymd",time()))) //如果文件夹不存在，则创建一个
        mkdir(date("Ymd",time()));  


    $filesName = $_FILES['file']['name'];  //文件名数组
    $filesTmpName = $_FILES['file']['tmp_name'];  //临时文件名数组

    $filePath = date("Ymd",time()).'/'.$filesName; //文件路径



    if(!file_exists(date("Ymd",time()).'/'.$filesName)){
        if(move_uploaded_file($filesTmpName, $filePath))
            echo $filePath;
        else {
            echo "移动文件失败";
        }
    }
    else
        echo "图片已存在！插入失败"
    //echo   "<img src= '".$filePath ."'>";

    
?>
