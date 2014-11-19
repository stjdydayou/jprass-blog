<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	function.jprass_ipinfo.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
function smarty_function_jprass_ipinfo($params){
     $ip = $params['ip'];
	 if($ip){
		$db = JPrassApi::getQuery("##_restricted_ip");
		$result = $db->find("id=".ip2long($ip));
		if($result)
			return $ip."(<font color=red>此IP受限</font>)";
		else
			return $ip;
	 }
}
?>
