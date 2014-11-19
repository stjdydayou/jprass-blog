<?php

/**
 * JPrass Blog
 * 文章页面
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	PageCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once 'BlogCtrl.php';

class PageCtrl extends BlogCtrl {

	public function index() {
		$aid = $this->request->aid;

		//读取内容
		$page = $this->db("##_article")->where("`id`=" . $aid." and type='page'")->find();

		if (!$page)
			throw new JprassException("您访问的文章不存在！", 404);

		$page['content'] = JPrassApi::ubbDecode(htmlspecialchars_decode($page['content']));

		//加载标签
		$page['tags'] = $this->db("##_article_tag")->field("a.tagname,a.id")->join("##_tag", "a on a.id=t.tagid")->where("a.id <>'' and t.aid=" . $page['id'])->findAll();

		//更新点击量
		$this->db("##_article")->where("`id`=" . $aid)->update(array("views" => $page['views'] + 1));

		//加载评论
		$comments = $this->db("##_comment")->field("t.*")->order("t.dateline asc")->where("t.`ischeck`=1 and t.aid=" . $aid)->findAll();
		$this->assign("comments", $comments);

		//设置页面标题关键词及描述
		$this->assign("title", $page['title']);

		//组织页面关键字
		$keywords = "";
		if ($page['tags'] && count($page['tags'])) {
			foreach ($page['tags'] as $key => $tag) {
				if ($key > 0)
					$keywords.="," . $tag['tagname'];
				else
					$keywords.=$tag['tagname'];
			}
			$this->assign("keywords", $keywords);
		}
		$this->assign("description", $page['description']);

		$this->assign("page", $page);
		return $this->theme . '/page';
	}

}
?>
