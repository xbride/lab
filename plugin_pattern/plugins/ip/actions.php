<?php
/**
 * 这是一个Hello World简单插件的实现
 *
 * @link    http://www.jb51.net/
 */
/**
 *需要注意的几个默认规则：
 *  1. 本插件类的文件名必须是action
 *  2. 插件类的名称必须是{插件名_actions}
 */
class IP_actions
{
  //解析函数的参数是pluginManager的引用
  function __construct(&$pluginManager)
  {
    //注册这个插件
    //第一个参数是钩子的名称
    //第二个参数是pluginManager的引用
    //第三个是插件所执行的方法
    $pluginManager->register('ip', $this, 'getip');
	$pluginManager->register('log', $this, 'logvisit');
	$pluginManager->register('today', $this, 'logtoday');
  }
  
  function getip()
  {
     static $realip;
		if (isset($_SERVER)){
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")){
				$realip = getenv("HTTP_X_FORWARDED_FOR");
			} else if (getenv("HTTP_CLIENT_IP")) {
				$realip = getenv("HTTP_CLIENT_IP");
			} else {
				$realip = getenv("REMOTE_ADDR");
			}
		}
		
		return $realip;
  }
  
  function logvisit($name)
  {		
		$fname = $name.".visit";
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
	
	function logtoday($name)
  	{		
		
		//$fname = $name.".visit";
		$fname = date("Y-m-d").".today";
		
		//echo $fname;
		if(is_readable($fname) == false){
			$myfile = fopen($fname, "w") or die("Unable to create file!");
			fclose($myfile);
		}
		
		$myfile = fopen($fname, "a") or die("Unable to create file!");
		fwrite($myfile, $name.": ".date("Y/m/d H:i:s")."\r\n");
		fclose($myfile);
		
		$content = file_get_contents($fname);
		$array = explode("\r\n", $content);
		
		return count($array)-1;
	}
  
}

?>