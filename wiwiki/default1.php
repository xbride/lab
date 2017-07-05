<html>
<body>
<?php
	if(isset($POST['action'])&&$_POST['action']=='submitted'){
		print '<pre> error!';
	}
	else
	{
?>
		<script language="JavaScript">
		function cheak(){
			var i=mainform.txtThis.value;
			window.location='<?php echo $_SERVER['PHP_SELF']; ?>?name='+i;
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
	
			<!--		
			Next:<input name="txt1" type="text" id="focuseId">		
			<br>
			<input type="submit" value="Go">
			-->
	
			<a onClick="cheak()" href="#" >Ã·Ωª</a>
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
