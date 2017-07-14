<!--
sheshimorendezifuchuan
-->

<html>
<body>
<?php
	$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	//echo dirname($url);
	$url=dirname($url);
	//echo $url;
	//echo "<br>";
	//$n= strrpos($url,"/");
	//echo $n;
	$name=substr($url,strrpos($url,"/")+1);
	echo $name;	
	echo ":<br>&nbsp;&nbsp;";


	$new=$_GET["new"];
	$text=$_GET["text"];
	if($new!=""){
		mkdir($new);					
		if($text!=""){
			$myfile = fopen($new."/".$new.".txt", "w") or die("Unable to open file!");
			fwrite($myfile, $text."\r\n");
			copy("index.txt",$new."/index.php");
		}
		
		$url = $new; 
		//echo $url;
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		//echo "?name='$name'";
		echo "</script>";
	}
	


	
	
	
	//echo "<br>";
	//echo $_SERVER['PHP_SELF'];
	
	//echo copy($_SERVER['PHP_SELF'],".\tmp.txt");
	
	$file = fopen($name.".txt", "r") or exit("无法打开文件!");
	// 读取文件每一行，直到文件结尾
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
	
	
	$filename=scandir("./"); //遍历当前目录下的所有文件及文件夹 
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //判断是否为文件夹
		{
			if($filename[$i]!="."&&$filename[$i]!="..")
				echo '<a href='.$filename[$i].'?name='.$name.'>'.$filename[$i].'</a>&nbsp;';
		}
	} 
	
	if(isset($POST['action'])&&$_POST['action']=='submitted'){
		print '<pre> error!';
	}
	else
	{
?>
		<script language="JavaScript">
		function cheak(){
			var i=mainform.txtThis.value;
			var j=mainform.txtNew.value;
			var k=mainform.textArea.value;
			window.location='<?php echo $_SERVER['PHP_SELF']; ?>?name='+i+'?new='+j+'?text='+k+;
		}
		</script>

		<form name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div>
			<input name="txtFrom" type="text" readonly="true"
				style="font-size:24px" value="<?php echo $_GET["name"]?>";>
			<br>
			<br>
			
			Name:<input name="txtThis" type="text" value="";>
			<br>
			<br>
			
						
			Nex: <input name="txtNew" type="text" value="";>
			<br><br>
			<textarea name="textArea" cols="" rows="5"></textarea>
			
	
			<!--		
			Next:<input name="txt1" type="text" id="focuseId">		
			<br>
			<input type="submit" value="Go">
			-->
	
			<a onClick="cheak()" href="#" >提交</a>
		</div>
		
		</form>
		
		
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
