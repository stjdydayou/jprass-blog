<?php

/**
 * JPrass Blog
 * 文章订阅
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	RssCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class RssCtrl extends BaseCtrl{
	/**
	 * 内容订阅
	 */
	public function index() {
		$field = "t.id,t.title,t.views,t.dateline,t.description";
		$list = $this->db("##_article")->field($field)->order("dateline desc")->findAll();
		$this->assign("list", $list);
		return "rss";
	}
}
?>
