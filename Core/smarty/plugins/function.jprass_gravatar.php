<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	function.jprass_gravatar.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
function smarty_function_jprass_gravatar($params) {
	$email = $params['email'];
	$s = !isset($params['s']) && empty($params['s']) ? 80 : $params['s'];
	$str = '<a href="http://www.gravatar.com/" target="_blank">';

	$str.='<img src="' . 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s=$s" . '" />';
	
	$str .="</a>";
	
	return $str;
}

?>
