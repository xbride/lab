<!-- 070711
sheshimorendezifuchuan
-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>

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

<?php 
	function getdirs($path, &$dirs, $name){	
		if(is_dir($path))
		{
			//$dirs[] = $path;
			$dp = dir($path);
			while($file = $dp->read()){
				if(($file!=".") && ($file!="..")){
					if(is_dir($path."/".$file)&&($name == $file))
					if(($name == $file))
						$dirs[] = $path;
					getdirs($path."/".$file, $dirs,  $name);
				}
			}	
			$dp -> close();	
		}
	}
	
	function getdirnamesbydir($dir, $name){
		$dirs = array();
		getdirs($dir, $dirs, $name);
		return $dirs;
	}
	
	/*
	$dirnames = getdirnamesbydir(".", "a");
	foreach($dirnames as $value){
		echo $value. "<br />";
	}
	*/
?>

<?php
	$level = $_GET["level"];
	if($level == "")
		$level = 1;
	else
		$level++;
	echo $level.'<br/>';
?>


<?php  //显示该名称的所有父级目录
	
	/*	显示当前目录名 $name	$urlall网页地址,  $url网页目录		* /
	$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url=dirname($urlall);
	$name=substr($url,strrpos($url,"/")+1);

	$dirnames = getdirnamesbydir(".", "$name");
	foreach($dirnames as $value){
		echo $value. "<br />";
	}
	/* */
?>

		<?php   
			//$dir = "."; 
			//chdir($dir);
			$images = glob("*.{gif,png,jpg,GIF,PNG,JPG}", GLOB_BRACE);
			$arrlength = count($images);
			//echo $arrlength;
			for($x=0; $x<$arrlength; $x++) 
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
	/*	显示当前目录名 $name
		$urlall网页地址,  $url网页目录		*/
	$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url=dirname($urlall);
	//echo $url;
	//echo "<br>";
	//$n= strrpos($url,"/");
	//echo $n;
	$name=substr($url,strrpos($url,"/")+1);
	echo "<b>".$name."</b>";	
	echo ":<br>&nbsp;&nbsp;&nbsp;&nbsp;";
		
	/* 	读取并显示当前目录描述		*/	
	$file = fopen($name.".txt", "r");// or exit("无法打开文件!");
	$count=0;
	while(!feof($file))
	{
		$count++;
		$s = fgets($file). "<br>";
		if($count==1)
			echo $s;
		else
			if($count>1)
				break;
	}
	fclose($file);
	
	/*	显示当前目录子链接		*/
	$filename=scandir("./"); //遍历当前目录下的所有文件及文件夹 
	//echo '<div style="width: 100px;height:100px;background-color:green;">';
	echo "<p>";
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //判断是否为文件夹
		{
			if($filename[$i]!="."&&$filename[$i]!="..")
				echo '<a href='.$filename[$i].'/indix.php?level='.$level.'&name='.$name.'>'.$filename[$i].'</a> ';
		}
	} 
	echo "</p>";
	//echo '</div>';
	
	
	/*  是否是新页
		$new 新地址
		$text 描述
		复制 indix模板
		转向新页 $new		*/
	$new=$_GET["new"];
	if($new!=""){
		mkdir($new);					
		copy("indix.txt",$new."/indix.php");
		copy("indix.txt",$new."/indix.txt");
		copy("handle.php",$new."/handle.php");	
		$text=$_GET["text"];
		if($text!="")
		{
			$filename = $new.".txt";
			$myfile = fopen($new."/".$new.".txt", "w") or die("Unable to open file!");
			if(!fwrite($myfile,$text."\r\n")){
				die("Unable to write file!");
			}
			fclose($myfile);
		}
	
		/*
		if($text!=""){
			$filename = $new.".txt";
			rename("tmp.txt", $new."/".$filename);	
		}
		*/

		$url = $new; 
		//echo $url;
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url/indix.php?level=$level&name=$name'";
		//echo "?name='$name'";
		echo "</script>";
	}

	
	/*	表单预处理 */
	if(isset($POST['action'])&&$_POST['action']=='submitted'){
		print '<pre> error!';
	}
	else
	{
	
?>

		<!-- 转到新页		-->
		<script language="JavaScript">
		function check(){
			var j=mainform.txtNew.value;
			var k=mainform.textArea.value;
			window.location='<?php echo $_SERVER['PHP_SELF']; ?>?new='+j+'&text='+k;
		}
		</script>

		<!-- 表单 -->
		<form name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div>
			<div align="center"><input name="txtFrom" type="text" readonly="true"
				style="font-size:24px" value="<?php echo $_GET["name"]?>";></div>
			<br>
			<br>

			<input name="txtNew" type="text" style="font-size:18px"; size="8"; value="";>:
			<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<!--<input name="textArea" type="text" style="font-size:18px"; value="" id="focuseId";>-->
			<textarea name="textArea" cols="" rows="" style="font-size:18px"; id="focuseId";></textarea>
			<br><br>
					
			
			<!--		
			Next:<input name="txt1" type="text" id="focuseId">		
			<br>
			<input type="submit" value="Go">
			-->
			<a onClick="check()" href="#" >提交</a>
		</div>
		
		</form>
		
		<form action="handle.php" name="form" method="post" enctype="multipart/form-data">   
			<input type="file" name="file" />
			<input type="submit" name="submit" value="上传" />
		</form> 

		
		<!-- 默认焦点 -->
		<script>
			window.onload = function() {
				document.getElementById("focuseId").focus();
			};
		</script>

<?php
	}
?>

</body>
</html>
