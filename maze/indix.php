<html>
<head>
<title>无标题文档</title>
</head>
<body>

<form action="handle.php" name="form" method="post" enctype="multipart/form-data">   
	<input type="file" name="file" />
	<input type="submit" name="submit" value="上传" />
</form> 

<?php   
	//$dir = ".";  
	//chdir($dir);  
	$images = glob("*.{gif,png,jpg}", GLOB_BRACE);	
	$arrlength = count($images);
	for($x=0;$x<$arrlength;$x++) 
	{
		if($x>0)
			break;
		echo ('<img src="');
		echo ("$images[$x]");
		echo (' />');
		echo ('<br><br>');
	}
?> 

<?php

	$SPACE = "__";
	$BLOCK = "●";
	$ENROAD = "＠";
	for($i=1; $i<=5; $i++)
	{
		for($j=1; $j<=5; $j++)
		{
			$filename = (string)$i.(string)$j;
			if(is_dir($filename))
			{
				if(!file_exists($filename."/road.txt")){
					echo '<a href="indix.php?act=new&name='.$filename.'">'.$SPACE.'<a>';
				}
				else{
					echo '<a href="indix.php?act=enter&name='.$filename.'">'.$ENROAD.'<a>';
				}
			}else{
				echo '<a href="indix.php?act=open&name='.$filename.'">'.$BLOCK.'<a>';
			}
		}
		echo "<br>";
	}
		
	//show img
	
	// add road
	$act = $_GET["act"];
	switch($act)
	{
		case "open": 
		case "new": 
		case "enter": 
		{
			$name = $_GET["name"];
			if($name!=" ")
			{
				mkdir($name);
				copy("indix.php",$name."/indix.php");
				copy("handle.php",$name."/handle.php");
				
				$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
				$url = dirname($urlall)."/".$name."/indix.php";
				echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='$url'";
				echo "</script>";
				
			}
		}break;
		
		default: break;
	}
	
	//
	
	
	
?>

</body>
</html>