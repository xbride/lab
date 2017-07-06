<?php

function visit($ip)
{
	/*
		log visitor ip and visit time summary to ip.log
		return record count
	*/
	
	/*
		if noexist 
			create
		add record
		return record count
	*/
	
	$fname = $ip.".ip";
	//echo $fname;
	if(is_readable($fname) == false){
		$myfile = fopen($fname, "w") or die("Unable to create file!");
		fclose($myfile);
	}
	
	$myfile = fopen($fname, "a") or die("Unable to create file!");
	fwrite($myfile, date("Y/m/d H:i:s")."\r\n");
	fclose($myfile);
	
	$content = file_get_contents($fname);
	$array = explode("\r\n", $content);
	
	return count($array)-1;
}

//echo visit("1.1.1.1");

?>