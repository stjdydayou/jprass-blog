<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	Config.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
if (!defined('__JPRASS_CORE_DIR__')) exit('request error');
return array
	(
	"db" => array(// 数据库连接配置
		"host" => "127.0.0.1", // 数据库地址
		"port" => 3306, // 端口
		"user" => "root", // 用户名
		"pwd" => "123456", // 密码
		"database" => "jprass_blog", //库名称
		"prefix" => "db_", //表前缀
		"characterSet" => "utf8", //编码格式
		"pconnect" => false
	),
	"default_route" => array(//初始路由方向
		"ctrl" => "main", // 默认的控制器名称
		"action" => "index"   // 默认的动作名称
	),
	"default_url" => array(
		"ctrl" => "c", // 请求时使用的控制器变量标识
		"action" => "a"  // 请求时使用的动作变量标识
	),
	"smarty" => array(//smarty配置模板配置
		'template_dir' => 'Tpl', // 模板目录
		'left_delimiter' => '<{', // smarty左限定符
		'right_delimiter' => '}>', // smarty右限定符
		'auto_literal' => true, // 忽略Smarty的左右限定符周围的空格
		'debugging' => false, //是否开启调试窗口
		'caching' => false, ////开启缓存，为flase的时候缓存无效
		'cache_lifetime' => 3600 //缓存生命同期,单位秒
	),
	"auto_session" => true, //是否自动开启SESSION支持
	"Debug" => false, //是否开启调试模式
	"dumpSql" => false, //是否自动输出执行过的SQL语句
	"theme" => "default", //是否自动开启SESSION支持
);
?>
