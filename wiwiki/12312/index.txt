<!--
sheshimorendezifuchuan
-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>无标题文档</title>
</head>

<body>
<?php
	
	$myfile = fopen("1.txt", "w") or die("Unable to open file!");
	if(!fwrite($myfile,"aaaaa\r\n")){
		die("Unable to write file!");
	}
	fclose($myfile);

	/*	显示当前目录名 $name
		$urlall网页地址,  $url网页目录		*/
	$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url=dirname($urlall);
	//echo $url;
	//echo "<br>";
	//$n= strrpos($url,"/");
	//echo $n;
	$name=substr($url,strrpos($url,"/")+1);
	echo $name;	
	echo ":<br>&nbsp;&nbsp;";
	
	/*  是否是新页
		$new 新地址
		$text 描述
		复制 index模板
		转向新页 $new		*/
	$new=$_GET["new"];
	$text=$_GET["text"];
	if($new!=""){
		mkdir($new);					
		copy("index.txt",$new."/index.php");
		copy("index.txt",$new."/index.txt");	
		$filename = $new.".txt";
		if($text!=""){
			$myfile = fopen($filename, "w") or die("Unable to open file!");
			if(!fwrite($myfile, $text."\r\n")){
				die("Unable to write file!");
			}
			fclose($myfile);
		}
		rename($filename, $new."/$filename");	

		$url = $new; 
		//echo $url;
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url/index.php?name=$name'";
		//echo "?name='$name'";
		echo "</script>";
	}
	
	/* 	读取并显示当前目录描述	*/	
	$file = fopen($name.".txt", "w");// or exit("无法打开文件!");
	$count=0;
	while(!feof($file))
	{
		$count++;
		$s=fgets($file). "<br>";
		if($count==2)
			echo $s;
		else
			if($count>2)
				break;
	}
	fclose($file);
	
	/*	显示当前目录子链接		*/
	$filename=scandir("./"); //遍历当前目录下的所有文件及文件夹 
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //判断是否为文件夹
		{
			if($filename[$i]!="."&&$filename[$i]!="..")
				echo '<a href='.$filename[$i].'?name='.$name.'>'.$filename[$i].'</a>&nbsp;';
		}
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
			<input name="txtFrom" type="text" readonly="true"
				style="font-size:24px" value="<?php echo $_GET["name"]?>";>
			<br>
			<br>
			
			Name:<input name="textArea" type="text" value="" id="focuseId";>
			<br>
			<br>
					
			Newx: <input name="txtNew" type="text" value="";>
			<br><br>
			
			<!--		
			Next:<input name="txt1" type="text" id="focuseId">		
			<br>
			<input type="submit" value="Go">
			-->
			<a onClick="check()" href="#" >提交</a>
		</div>
		
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
