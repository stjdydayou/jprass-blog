<?php

/**
 * JPrass Blog
 * 服务器请求处理类
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	HttpRequest.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class JPrass_HttpRequest {

	private $_client_IP;
	private $_params = array();

	public function __construct() {
		$this->_params['_ctrl'] = StringFilter::val($this->get(JPrassApi::C("default_url.ctrl"), JPrassApi::C("default_route.ctrl")))->filter("url");
		$this->_params['_action'] = StringFilter::val($this->get(JPrassApi::C("default_url.action"), JPrassApi::C("default_route.action")))->filter("url");
		$this->_params['_request_method'] = strtolower($_SERVER['REQUEST_METHOD']);

		/** 处理PHP的magic_quotes，对所有服务器的PHP版本兼容 */
		if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
			$_GET = JPrassApi::stripslashes($_GET);
			$_POST = JPrassApi::stripslashes($_POST);
			$_COOKIE = JPrassApi::stripslashes($_COOKIE);
			reset($_GET);
			reset($_POST);
			reset($_COOKIE);
		}
	}

	/**
	 * 获取实际传递参数(magic)
	 *
	 * @access public
	 * @param string $key 指定参数
	 * @return void
	 */
	public function __get($key) {
		return $this->get($key);
	}

	/**
	 * 判断参数是否存在
	 *
	 * @access public
	 * @param string $key 指定参数
	 * @return void
	 */
	public function __isset($key) {
		return isset($_GET[$key]) || isset($_POST[$key]) || isset($_COOKIE[$key]) || isset($this->_params[$key]);
	}

	/**
	 * 获取实际传递参数
	 *
	 * @access public
	 * @param string $key 指定参数
	 * @param mixed $default 默认参数 (default: NULL)
	 * @return void
	 */
	public function get($key, $default = NULL) {
		$value = $default;
		switch (true) {
			case isset($this->_params[$key]):
				$value = $this->_params[$key];
				break;
			case isset($_GET[$key]):
				$value = $_GET[$key];
				break;
			case isset($_POST[$key]):
				$value = $_POST[$key];
				break;
			case isset($_COOKIE[$key]):
				$value = $_COOKIE[$key];
				break;
			default:
				$value = $default;
				break;
		}

		return is_array($value) || strlen($value) > 0 ? $value : $default;
	}

	/**
	 * 获取当前pathinfo
	 *
	 * @access public
	 * @param string $inputEncoding 输入编码
	 * @param string $outputEncoding 输出编码
	 * @return string
	 */
	public function getPathInfo($inputEncoding = NULL, $outputEncoding = NULL) {
		/** 缓存信息 */
		if (NULL !== $this->_pathInfo) {
			return $this->_pathInfo;
		}

		//参考Zend Framework对pahtinfo的处理, 更好的兼容性
		$pathInfo = NULL;

		//处理requestUri
		$requestUri = NULL;

		if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // check this first so IIS will catch
			$requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
		} elseif (
		// IIS7 with URL Rewrite: make sure we get the unencoded url (double slash problem)
				isset($_SERVER['IIS_WasUrlRewritten']) && $_SERVER['IIS_WasUrlRewritten'] == '1' && isset($_SERVER['UNENCODED_URL']) && $_SERVER['UNENCODED_URL'] != ''
		) {
			$requestUri = $_SERVER['UNENCODED_URL'];
		} elseif (isset($_SERVER['REQUEST_URI'])) {
			$requestUri = $_SERVER['REQUEST_URI'];
			if (isset($_SERVER['HTTP_HOST']) && strstr($requestUri, $_SERVER['HTTP_HOST'])) {
				$parts = @parse_url($requestUri);

				if (false !== $parts) {
					$requestUri = (empty($parts['path']) ? '' : $parts['path'])
							. ((empty($parts['query'])) ? '' : '?' . $parts['query']);
				}
			}
		} elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0, PHP as CGI
			$requestUri = $_SERVER['ORIG_PATH_INFO'];
			if (!empty($_SERVER['QUERY_STRING'])) {
				$requestUri .= '?' . $_SERVER['QUERY_STRING'];
			}
		} else {
			return $this->_pathInfo = '/';
		}

		//处理baseUrl
		$filename = (isset($_SERVER['SCRIPT_FILENAME'])) ? basename($_SERVER['SCRIPT_FILENAME']) : '';

		if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $filename) {
			$baseUrl = $_SERVER['SCRIPT_NAME'];
		} elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $filename) {
			$baseUrl = $_SERVER['PHP_SELF'];
		} elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename) {
			$baseUrl = $_SERVER['ORIG_SCRIPT_NAME']; // 1and1 shared hosting compatibility
		} else {
			// Backtrack up the script_filename to find the portion matching
			// php_self
			$path = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
			$file = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
			$segs = explode('/', trim($file, '/'));
			$segs = array_reverse($segs);
			$index = 0;
			$last = count($segs);
			$baseUrl = '';
			do {
				$seg = $segs[$index];
				$baseUrl = '/' . $seg . $baseUrl;
				++$index;
			} while (($last > $index) && (false !== ($pos = strpos($path, $baseUrl))) && (0 != $pos));
		}

		// Does the baseUrl have anything in common with the request_uri?
		$finalBaseUrl = NULL;

		if (0 === strpos($requestUri, $baseUrl)) {
			// full $baseUrl matches
			$finalBaseUrl = $baseUrl;
		} else if (0 === strpos($requestUri, dirname($baseUrl))) {
			// directory portion of $baseUrl matches
			$finalBaseUrl = rtrim(dirname($baseUrl), '/');
		} else if (!strpos($requestUri, basename($baseUrl))) {
			// no match whatsoever; set it blank
			$finalBaseUrl = '';
		} else if ((strlen($requestUri) >= strlen($baseUrl)) && ((false !== ($pos = strpos($requestUri, $baseUrl))) && ($pos !== 0))) {
			// If using mod_rewrite or ISAPI_Rewrite strip the script filename
			// out of baseUrl. $pos !== 0 makes sure it is not matching a value
			// from PATH_INFO or QUERY_STRING
			$baseUrl = substr($requestUri, 0, $pos + strlen($baseUrl));
		}

		$finalBaseUrl = (NULL === $finalBaseUrl) ? rtrim($baseUrl, '/') : $finalBaseUrl;

		// Remove the query string from REQUEST_URI
		if ($pos = strpos($requestUri, '?')) {
			$requestUri = substr($requestUri, 0, $pos);
		}

		if ((NULL !== $finalBaseUrl) && (false === ($pathInfo = substr($requestUri, strlen($finalBaseUrl))))) {
			// If substr() returns false then PATH_INFO is set to an empty string
			$pathInfo = '/';
		} elseif (NULL === $finalBaseUrl) {
			$pathInfo = $requestUri;
		}

		if (!empty($pathInfo)) {
			//针对iis的utf8编码做强制转换
			//参考http://docs.moodle.org/ja/%E5%A4%9A%E8%A8%80%E8%AA%9E%E5%AF%BE%E5%BF%9C%EF%BC%9A%E3%82%B5%E3%83%BC%E3%83%90%E3%81%AE%E8%A8%AD%E5%AE%9A
			if (!empty($inputEncoding) && !empty($outputEncoding) &&
					(stripos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false || stripos($_SERVER['SERVER_SOFTWARE'], 'ExpressionDevServer') !== false)) {
				if (function_exists('mb_convert_encoding')) {
					$pathInfo = mb_convert_encoding($pathInfo, $outputEncoding, $inputEncoding);
				} else if (function_exists('iconv')) {
					$pathInfo = iconv($pathInfoEncoding, $outputEncoding, $pathInfo);
				}
			}
		} else {
			$pathInfo = '/';
		}

		// fix issue 456
		return ($this->_pathInfo = '/' . ltrim(urldecode($pathInfo), '/'));
	}

	/**
	 * 获取ip地址
	 * @access public
	 * @return string
	 */
	public function getClientIP() {
		if (NULL === $this->_client_IP) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

				$pos = array_search('unknown', $arr);

				if (false !== $pos)
					unset($arr[$pos]);

				$this->_client_IP = trim($arr[0]);
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {

				$this->_client_IP = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (isset($_SERVER['REMOTE_ADDR'])) {

				$this->_client_IP = $_SERVER['REMOTE_ADDR'];
			}
			// IP地址合法验证
			$this->_client_IP = (false !== ip2long($this->_client_IP)) ? $this->_client_IP : '0.0.0.0';
		}

		return $this->_client_IP;
	}

	/**
	 * 设置http传递参数
	 *
	 * @access public
	 * @param string $name 指定的参数
	 * @param mixed $value 参数值
	 * @return void
	 */
	public function setParam($name, $value) {

		$this->_params[$name] = $value;
	}

	/**
	 * 设置多个参数
	 *
	 * @access public
	 * @param mixed $params 参数列表
	 * @return void
	 */
	public function setParams($params) {
		$this->_params = array_merge($this->_params, $params);
	}

}
