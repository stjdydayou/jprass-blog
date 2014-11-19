<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	function.jprass_url.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once __JPRASS_CORE_DIR__ . '/BlogRouter.class.php';

function smarty_function_jprass_url($params) {
	$module = isset($params['module']) ? $params['module'] : null;
	$id = isset($params['id']) ? $params['id'] : null;
	$dateline = isset($params['dateline']) ? $params['dateline'] : null;
	return BlogRouter::buildUrl($module, $id, $dateline);
}

?>
