<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	Api.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
if (!defined('__JPRASS_CORE_DIR__'))
	exit('request error');

class JPrassApi {

	/**
	 * 获取配置参数
	 * @param String $arg
	 * @return Object
	 */
	public static function C($arg) {
		$args = explode(".", $arg);
		$config = "";
		foreach ($args as $k => $v) {
			if ($k > 0) {
				$config = $config[$v];
			} else {
				if (!isset($GLOBALS['_JPRASS_CONFIG_'])) {
					$GLOBALS['_JPRASS_CONFIG_'] = require_once(__JPRASS_CORE_DIR__ . '/Config.php');
					if (file_exists(__JPRASS_RUNTIME_PATH__ . '/Option.php')) {
						$GLOBALS['_JPRASS_CONFIG_'] = array_merge($GLOBALS['_JPRASS_CONFIG_'], require_once(__JPRASS_RUNTIME_PATH__ . '/Option.php'));
					}
				}
				$config = $GLOBALS['_JPRASS_CONFIG_'][$v];
			}
		}
		return $config;
	}

	/**
	 * 初始化一个数据模型
	 */
	public static function getQuery($table = null) {

		if (!defined("__JPRASS_DB__"))
			define('__JPRASS_DB__', Mysql::connect(JPrassApi::C("db")));

		$query = new Query(__JPRASS_DB__);
		if ($table) {
			$query->table($table);
		}
		return $query;
	}

	/**
	 * 格式化输出变量程序
	 * @param Object $var
	 * @param boolean $strict
	 */
	public static function dump($var, $strict = false) {
		if (!$strict) {
			if (ini_get('html_errors')) {
				$output = print_r($var, true);
				$output = '<pre>' . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			} else {
				$output = print_r($var, true);
			}
		} else {
			ob_start();
			var_dump($var);
			$output = ob_get_clean();
			if (!extension_loaded('xdebug')) {
				$output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
				$output = '<pre>' . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
			}
		}
		echo($output);
	}

	/**
	 * 输出错误页面
	 *
	 * @access public
	 * @param mixed $exception 错误信息
	 * @return void
	 */
	public static function handlerException($exception) {
		if (!is_object($exception)) {
			$exception = new Exception("", $exception, "");
		}

		$httpStatusCode = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		/** 设置http code */
		if (is_numeric($exception->getCode()) && $exception->getCode() > 200) {
			if (isset($httpStatusCode[$exception->getCode()])) {
				header('HTTP/1.1 ' . $exception->getCode() . ' ' . $httpStatusCode[$exception->getCode()], true, $exception->getCode());
			}
		}
		require_once __JPRASS_CORE_DIR__ . "/misc/handler_exception.php";
		exit;
	}

	/**
	 * 重定向函数
	 *
	 * @access public
	 * @param string $location 重定向路径
	 * @param boolean $isPermanently 是否为永久重定向
	 * @return void
	 */
	public static function redirect($location) {
		if ($location == -1) {
			//获取来源
			$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
			//判断来源
			if (!empty($referer)) {
				self::redirect($referer);
			} else {
				self::redirect("index.php");
			}
			exit;
		} else {
			$location = StringFilter::val($location)->filter('url');
			header('Location: ' . $location, false, 301);
			exit;
		}
	}

	/**
	 * 递归去掉数组反斜线
	 * @param mixed $value
	 * @return mixed
	 */
	public static function stripslashes($value) {
		return is_array($value) ? array_map(array('JPrassApi', 'stripslashes'), $value) : stripslashes($value);
	}

	/**
	 * ubb解码
	 * @param String $str
	 * @return String
	 */
	public static function ubbDecode($str) {
		//$conver_str = eregi_replace('\[upload=([0-9]+)]', $_CACHE['config']['blog']['url'] . '/attachment.php?id=\\1', $conver_str);
		//$conver_str = str_replace(array('[b]', '[/b]'), array('<b>', '</b>'), $conver_str);
		$str = preg_replace('/\[img]([^\[]*)\[\/img]/', '<img src="' . JPrassApi::C('blog.url') . '/\\1" />', $str);
		//$conver_str = eregi_replace('\[url=([^\[]*)]([^\[]*)\[/url]', '<a href="\\1" title="\\2" target="_blank">\\2</a>', $conver_str);
		$conver_str = preg_replace('/\[file]([^\[]+)\[\/file]/', '<a href="' . JPrassApi::C('blog.url') . '/\\1">\\1</a>', $str);
		return $conver_str;
	}

}

?>
