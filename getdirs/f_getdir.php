<?php

function get_allfiles($path, &$files) {
    if(is_dir($path)){
		$files[] =  $path;
        $dp = dir($path);
        while ($file = $dp ->read()){  
            if($file !="." && $file !=".."){  
                get_allfiles($path."/".$file, $files);  
            }  
        }  
        $dp ->close();  
    }  
    if(is_file($path)){  
        //$files[] =  $path;  
    }  
}  
     
function get_filenamesbydir($dir){  
    $files =  array();  
    get_allfiles($dir,$files);  
    return $files;  
}  
     
$filenames = get_filenamesbydir("./");  
//��ӡ�����ļ���������·��  
foreach ($filenames as $value) {  
    echo $value."<br />";  
} 

?>