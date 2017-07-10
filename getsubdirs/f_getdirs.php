<?php 

	function getdirs($path, &$dirs, $name)
	{	
		if(is_dir($path))
		{
			//$dirs[] = $path;
			$dp = dir($path);
			while($file = $dp->read())
			{
				if(($file!=".") && ($file!=".."))
				{
					if(is_dir($path."/".$file)&&($name == $file))
					if(($name == $file))
						$dirs[] = $path;
					getdirs($path."/".$file, $dirs,  $name);
				}
			}	
			$dp -> close();	
		}
		if(is_file($path)){  
        //$files[] =  $path;  
   		}  
	}

	
	function getdirnamesbydir($dir, $name)
	{
		$dirs = array();
		getdirs($dir, $dirs, $name);
		return $dirs;
	}
	
	
	$dirnames = getdirnamesbydir(".", "a");
	
	foreach($dirnames as $value)
	{
		echo $value. "<br />";
	}
	
	

?>