<!--
sheshimorendezifuchuan
-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>�ޱ����ĵ�</title>
</head>

<body>
<?php	
	/*	��ʾ��ǰĿ¼�� $name
		$urlall��ҳ��ַ,  $url��ҳĿ¼		*/
	$urlall='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url=dirname($urlall);
	//echo $url;
	//echo "<br>";
	//$n= strrpos($url,"/");
	//echo $n;
	$name=substr($url,strrpos($url,"/")+1);
	echo $name;	
	echo ":<br>&nbsp;&nbsp;";
		
	/* 	��ȡ����ʾ��ǰĿ¼����		*/	
	$file = fopen($name.".txt", "r");// or exit("�޷����ļ�!");
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
	
	/*	��ʾ��ǰĿ¼������		*/
	$filename=scandir("./"); //������ǰĿ¼�µ������ļ����ļ��� 
	for($i=0;$i<sizeof($filename);$i++)
	{
		if(is_dir($filename[$i]))  //�ж��Ƿ�Ϊ�ļ���
		{
			if($filename[$i]!="."&&$filename[$i]!="..")
				echo '<a href='.$filename[$i].'/index.php?name='.$name.'>'.$filename[$i].'</a>&nbsp;';
		}
	} 
	
	/*  Ԥд�������� $text		*/
	$text=$_GET["text"];
	if($text!="")
	{
		$myfile = fopen("tmp.txt", "w") or die("Unable to open file!");
		if(!fwrite($myfile,$text."\r\n")){
			die("Unable to write file!");
		}
		fclose($myfile);
	}
	
	
	
	/*  �Ƿ�����ҳ
		$new �µ�ַ
		$text ����
		���� indexģ��
		ת����ҳ $new		*/
	$new=$_GET["new"];
	if($new!=""){
		mkdir($new);					
		copy("index.txt",$new."/index.php");
		copy("index.txt",$new."/index.txt");	
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
		echo "window.location.href='$url/index.php?name=$name'";
		//echo "?name='$name'";
		echo "</script>";
	}

	
	/*	����Ԥ���� */
	if(isset($POST['action'])&&$_POST['action']=='submitted'){
		print '<pre> error!';
	}
	else
	{
	
?>

		<!-- ת����ҳ		-->
		<script language="JavaScript">
		function check(){
			var j=mainform.txtNew.value;
			var k=mainform.textArea.value;
			window.location='<?php echo $_SERVER['PHP_SELF']; ?>?new='+j+'&text='+k;
		}
		</script>

		<!-- ���� -->
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
			<a onClick="check()" href="#" >�ύ</a>
		</div>
		
		</form>
		
		<!-- Ĭ�Ͻ��� -->
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