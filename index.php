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

//引用mvc框架入口
require_once "JPrass.php";

require_once __JPRASS_CORE_DIR__."/BlogRouter.class.php";

try {
	/** 初始化一个请求 */
	$request = new JPrass_HttpRequest();
	
	/**使用自定义分发规则进行请求分发*/
	BlogRouter::dispatch($request);
	
	//创建主体对象
	$JPrass = new JPrass($request);
	
	/** 执行主方法 */
	$JPrass->run();
	
} catch (Exception $exp) {
	JPrassApi::handlerException($exp);
}
