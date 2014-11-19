<?php
/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	index.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */

//引用mvc框架
require_once "../JPrass.php";

try {
	
	$JPrass = new JPrass(new JPrass_HttpRequest());
	
	$JPrass->run();
	
} catch (Exception $exp) {
	JPrassApi::handlerException($exp);
}
