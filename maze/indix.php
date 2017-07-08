<html>
<head>

<!-- 自适应代码-->	
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<!-- 自适应代码-->	

<!-- 自适应代码 自动换行-->
<style type="text/css"> 
pre{
white-space: pre-wrap;       /* css-3 */ 
white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */ 
white-space: -pre-wrap;      /* Opera 4-6 */ 
white-space: -o-pre-wrap;    /* Opera 7 */ 
word-wrap: break-word;       /* Internet Explorer 5.5+ */ 
} 
</style>
<!-- 自适应代码-->

	<!-- 自适应代码-->
	<style type="text/css"> 
	#divMain_mobile{display:none}
	@media(max-width:960px)
	{
  

    /* 为了避免正文图片超出屏幕宽度 */
    /* 正文图片宽度最多是屏幕宽度的90% */
    #divProduct img{max-width:90%} 
	
	
	#divMain{display:none}
	
	#divMain_mobile{display:block}
	#divMain_mobile img{max-width:99%} 

    
	}
	</style>
	<!-- 自适应代码-->
	
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
		echo ('<div align="center" id="divProduct">');
		echo ('<img src="');
		echo ("$images[$x]");
		echo ('" />');
		echo ('<br><br>');
		echo ('</div>');
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