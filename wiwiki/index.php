<!-- 07150125
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

<?php //功能函数
	include "f_getdirs.php";
?>

<?php  //获得层数  $level 与图片地址
	$filename = "config.ini";
	if (is_readable($filename) == false) { 
		$myfile = fopen($filename, "w") or die("Unable to open file!");
		$level = $_GET["level"];
		if($level == "")
			$level = 0;
		fwrite($myfile, $level."\r\n");
		$imgurl = $_GET["imgurl"];
		if($imgurl != "")
			fwrite($myfile, $imgurl."\r\n");
		fclose($myfile);
	}
	
	$content = file_get_contents($filename);
	$array = explode("\r\n", $content);
	$level = $array[0];
	if($level == "")
		$level = 0;
	$imgurl = $array[1];
	if($imgurl == "")
		$imgurl = $_GET["imgurl"];
?>

<?php  //显示该名称的所有父级目录   IO
	
	/*	显示当前目录名 $name	$urlall网页地址,  $url网页目录		*/
	$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url=dirname($urlall);
	$name=0;
	if(strpos($url,"?")){
		$name=substr($url,0,strpos($url,"?")-10);
		$name=substr($name,strrpos($name,"/")+1);
	}
	else{
		$name=substr($url,strrpos($url,"/")+1);
	}
	
	$cnt = $level;
	while(($cnt--)>0)
		$s=$s."../";

	//echo "s：".$s."<br/ >";
	//echo "name：".$name."<br/ >";

	$dirnames = getdirnamesbydir($s, $name);
	foreach($dirnames as $value){
		//echo "<br>[".$value."]<br>";  
		$str=substr($value,strrpos($value,"/")+1);
		if($str == ""){
			$str = "(root)";
			echo '<a href="'.$value.'/index.php">';	
		}
		else{
			echo '<a href="'.$value.'/indix.php">';
		}
		echo '<font size="4">'.$str.'<font></a> ';
	}
	echo '<br><br>';
	/* */
?>

		<?php   //显示图像
			//$dir = "."; 
			//chdir($dir);
			if($imgurl == "")
				$imgurl = $_GET["imgurl"];
			echo ('<div align="center" id="divProduct">');
			if($imgurl != "")
				echo '<img src="'.$imgurl.'">';
			echo ('</div>');
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
	$name=0;
	if(strpos($url,"?")){
		$name=substr($url,0,strpos($url,"?")-10);
		$name=substr($name,strrpos($name,"/")+1);
	}
	else{
		$name=substr($url,strrpos($url,"/")+1);
	}
	echo '['.$level.']';
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
	
	/*	显示当前目录子链接		  IO 	*/
	$filename=scandir("./"); //遍历当前目录下的所有文件及文件夹 
	//echo '<div style="width: 100px;height:100px;background-color:green;">';
	echo "<p>";
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //判断是否为文件夹
		{
			$lvl=$level;
			if($filename[$i]!="."&&$filename[$i]!="..")
				echo '<a href='.$filename[$i].'/indix.php?imgurl='.$imgurl.'&level='.$lvl.'&name='.$name.'>'.$filename[$i].'</a> ';
		}
	} 
	echo "</p>";
	//echo '</div>';
	
	
	/*  是否yao开新页
		$new 新地址
		$text 描述
		复制 indix模板
		转向新页 $new		IO		*/
	$new=$_GET["new"];
	if($new != "")
	{
		mkdir($new);					
		copy("indix.txt",$new."/indix.php");
		copy("indix.txt",$new."/indix.txt");
		copy("handle.php",$new."/handle.php");	
		copy("f_getdirs.php",$new."/f_getdirs.php");  
		copy("gb2312.txt",$new."/gb2312.txt");  
		copy("zys.txt",$new."/zys.txt");  
		
		
		$lvl = $level+1;
		$fconfig = fopen($new."/"."config.ini", "w") or die("Unable to open file!"."config.ini");
		if(!fwrite($fconfig,$lvl."\r\n")){
			die("Unable to write file!"."config.ini");
		}
		if(!fwrite($fconfig,$imgurl."\r\n")){
			die("Unable to write file!"."config.ini");
		}
		
		fclose($fconfig);
	
/*	
//		if(rand(0,2) == 0)
//		{
			$fn = $new."/".$new.".txt";
			if(file_exist($fn)){
				copy($fn, $fn.date("YmdHis"));
			}
//		}
*/	
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
		$lvl = $level+1;
		$img=$_GET["imgurl"];
		//echo $url;
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url/indix.php?imgurl=$img&level=$lvl&name=$name'";
		//echo "?name='$name'";
		echo "</script>";
	}
	else //$new = "" 
	{
		/*
		
		*/
		//*GBK ALLOC		
		
		//getlength
		
				
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
			var m=mainform.txtimgurl.value;
			window.location='<?php echo $_SERVER['PHP_SELF']; ?>?level=<?php 
			$lvl = $_GET["level"];
			echo $lvl; ?>&new='+j+'&text='+k+'&imgurl='+m;
		}
		
		 function myFocus(obj){
             //判断文本框中的内容是否是默认内容
               obj.value="";
         }
		 
		</script>

		<!-- 表单 -->
		<form name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div>
			<div align="center"><input name="txtFrom" type="text" readonly="true"
				style="font-size:24px" value="<?php echo $_GET["name"]?>";></div>
			<br>
			<br>

			<input name="txtNew" type="text" style="font-size:18px"; size="8"; value="<?php //
			function getrand($filename, $width){
				$size = filesize($filename);
				$len = $size/2;
				$pos = rand(0, $len-$width)*2;
				$file = fopen($filename,"r");
				fseek($file,$pos);
				$contents = fread($file, $width*2);
				fclose($file);
				return $contents;
			}
	
			do{
				if(rand(0,2) == 0)
					$new = getrand("gb2312.txt",1);
				else
					$new = getrand("gb2312.txt",1);
			}while(file_exists($new));
			echo $new;
			?>";
			
			onFocus="myFocus(this)"
			>:
			<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<!--<input name="textArea" type="text" style="font-size:18px"; value="" id="focuseId";>-->
			<textarea name="textArea" cols="24" rows="5" style="font-size:18px"; id="focuseId";></textarea>
			<br><br>
					
			
			<!--		
			Next:<input name="txt1" type="text" id="focuseId">		
			<br>
			<input type="submit" value="Go">
			-->
			<a onClick="check()" href="#" >提交(URL)</a>: 
			<input name="txtimgurl" type="text" size="30" value="";>

		</div>
		
		</form>
		
		<form action="handle.php" name="form" method="post" enctype="multipart/form-data">   
			<input type="file" name="file" />
			<input type="submit" name="submit" value="上传" />
		</form> 

		<?php   //显示图像
			//$dir = "."; 
			//chdir($dir);
			echo ('<div align="center" id="divProduct">');
					
			$images = glob("*.{gif,png,jpg,GIF,PNG,JPG}", GLOB_BRACE);
			$arrlength = count($images);
			//echo $arrlength;
			for($x=0; $x<$arrlength; $x++)
			{
				if($x>0)
					break;
				
				echo ('<img src="');
				echo ("$images[$x]");
				echo ('" />');
				echo ('<br><br>');
			}
			echo ('</div>');
		?> 
		
						
		
		<!-- 默认焦点 -->
		<script>
			window.onload = function() {
				document.getElementById("focuseId").focus();
			};
		</script>

<?php
	}
?>

<div align="center">
<br><br><br><br><br>
<?php 
	if($level>=1)
	{
		echo '<a href="https://zh.wikipedia.org/zh/%E4%B8%8D%E4%BD%9C%E6%81%B6">Dontbe1vil<a>';
	}
?>

</div>
</body>
</html>
