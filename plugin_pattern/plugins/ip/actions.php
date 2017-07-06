<?php
/**
 * ����һ��Hello World�򵥲����ʵ��
 *
 * @link    http://www.jb51.net/
 */
/**
 *��Ҫע��ļ���Ĭ�Ϲ���
 *  1. ���������ļ���������action
 *  2. ���������Ʊ�����{�����_actions}
 */
class IP_actions
{
  //���������Ĳ�����pluginManager������
  function __construct(&$pluginManager)
  {
    //ע��������
    //��һ�������ǹ��ӵ�����
    //�ڶ���������pluginManager������
    //�������ǲ����ִ�еķ���
    $pluginManager->register('ip', $this, 'getip');
	$pluginManager->register('log', $this, 'logvisit');
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
  
}

?>