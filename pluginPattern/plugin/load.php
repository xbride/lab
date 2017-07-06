<?php
	$filename=scandir("./"); //遍历子目录plugin目录下的所有文件及文件夹 
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //判断是否为文件夹
		{
			if(($filename[$i]!=".")&&($filename[$i]!="..")){
				
				//echo '<a href='.$filename[$i].'?name='.$name.'>'.$filename[$i].'</a>&nbsp;';
				
				//load php in the folder
				
				
				//echo $filename[$i];
				
				chdir("./".$filename[$i]);				
				echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='$filename[$i]/$filename[$i].php'";
				echo "</script>";
				chdir("..")
				
			}
		}
	}

?>