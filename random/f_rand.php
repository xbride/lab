<?php
	
	$n=rand(0,4);
	
	//rename($n.".txt", "a.txt");
	
	echo $n;
	
	copy($n.".txt", "a.txt");
	
?>