<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	BlogRouter.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class BlogRouter {

	private static $rules = array(
		Array(
			'handle' => 'category:index',
			'regx' => '/category[/]?([0-9]+)?[/]?([0-9]+)?',
			'params' => Array(0 => 'cid', 1 => 'p')
		),
		Array(
			'handle' => 'article:index',
			'regx' => '/article/(20[0-9]{4})/([0-9]+)',
			'params' => Array(0 => 'years', 1 => 'aid')
		),
		Array(
			'handle' => 'article:index',
			'regx' => '/article/([0-9]+)[/]?',
			'params' => Array(0 => 'aid')
		),
		Array(
			'handle' => 'archives:index',
			'regx' => '/archives[/]?(20[0-9]{4})?[/]?([0-9]+)?',
			'params' => Array(0 => 'years', 1 => 'p')
		),
		Array(
			'handle' => 'tag:index',
			'regx' => '/tag[/]?([0-9]+)?[/]?([0-9]+)?',
			'params' => Array(0 => 'tagid', 1 => 'p')
		),
		Array(
			'handle' => 'page:index',
			'regx' => '/page/([0-9]+)?',
			'params' => Array(0 => 'aid')
		),
		Array(
			'handle' => 'weixin:index',
			'regx' => '/weixin[/]?',
			'params' => Array()
		),
		Array(
			'handle' => 'yixin:index',
			'regx' => '/yixin[/]?',
			'params' => Array()
		)
	);

	public static function dispatch(JPrass_HttpRequest &$request) {

		$pathInfo = $request->getPathInfo();
		$urlExt = JPrassApi::C("permalink.url_ext");

		/** 首页 */
		if (preg_match("|^[/]?$|", $pathInfo))
			return;

		/** Rss订阅 */
		if (preg_match("|^/rss$|", $pathInfo)) {
			$request->setParam("_ctrl", "rss");
			return;
		}

		//通过路由方式选择处理器
		$matches = array();

		foreach (self::$rules as $rule) {
			if (preg_match("|" . $rule['regx'] . $urlExt . "$|", $pathInfo, $matches)) {
				$handle = explode(":", $rule['handle']);

				$request->setParam("_ctrl", $handle[0]);
				$request->setParam("_action", $handle[1]);

				/** 载入参数 */
				$params = array();
				if (isset($rule['params']) && !empty($rule['params'])) {
					unset($matches[0]);
					while (count($matches)) {
						$params[array_shift($rule['params'])] = array_shift($matches);
					}
				}

				$request->setParams($params);
				return;
			}
		}
		throw new JprassException("您访问的页面不存在", 404);
	}

	/**
	 * 构建URL地址
	 * @param type $module
	 * @param type $id
	 * @param type $dateline
	 * @return string
	 */
	public static function buildUrl($module, $id = null, $dateline = null) {
		$ext = JPrassApi::C("permalink.url_ext");
		$url = JPrassApi::C("blog.url");
		if (JPrassApi::C("permalink.rewrite") !== "1") {
			$url.="/index.php";
		}
		$url.="/" . $module;

		if ($module == 'article' && JPrassApi::C("permalink.archives_url_pattern") === "2" && !empty($dateline)) {
			$url.="/" . date("Ym", $dateline);
		}

		if (!empty($id)) {
			$url.="/" . $id;
		}
		$url.=$ext;
		return $url;
	}

}
