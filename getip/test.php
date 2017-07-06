<html>
<head>
<title>无标题文档</title>
	<!-- get ip wuxiao <script type="text/javascript" src="f_getIP.php"></script> -->
</head>

<body>

<?php 
	include "f_getIP.php";
	include "f_visit.php"; 
	$ip = getIP();
	//echo $ip."<br>"."访问次数：".visit($ip);
?>

</body>
</html>
