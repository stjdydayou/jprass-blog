<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	Notice.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class Notice {

	/**
	 * 执行函数
	 * @access public
	 * @return void
	 */
	public static function execute() {
		$__jprass_message = Cookie::get('__jprass_message');
		if (NULL !== $__jprass_message) {
			echo '<script type="text/javascript" src="'.JPrassApi::c('blog.url').'/Script/jquery.sdialog.js"></script>';
			echo '<script type="text/javascript">$.sdialog({content: "'.$__jprass_message.'"}).ok(true);</script>';
		}
	}

	/**
	 * 设定堆栈每一行的值
	 *
	 * @param string $name 值对应的键值
	 * @param mixed $name 相应的值
	 * @param string $type 提示类型
	 * @return array
	 */
	public static function set($message) {
		Cookie::set('__jprass_message', $message, time() + 86400);
	}

}

?>
