<?php
	$addr = $_GET["addr"];
	if($addr!=""){
		mkdir($addr);
		copy("test.php",$addr."/index.php");
		echo '<script language="JavaScript">';
		echo 'window.location="'.$addr.'"';
		echo '</script>';
	}
?>

<html>
<body>

<script language="JavaScript">
	function check(){
		var j=headerForm.site.value;
		window.location='<?php echo $_SERVER['PHP_SELF']; ?>'+'?addr='+j;
	}
</script>
		

<form name="headerForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div >
		<input name="site" type="text" value="输入要访问(qiandao)的地址" size="40" />
		<a onClick="check()" href="#">提交</a>
	</div>
</form>

</body>
</html>