<?php
	$filename=scandir("./"); //������Ŀ¼pluginĿ¼�µ������ļ����ļ��� 
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //�ж��Ƿ�Ϊ�ļ���
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