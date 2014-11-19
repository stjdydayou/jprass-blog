<?php

/**
 * JPrass Blog
 * 文章页面
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	ArticleCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once 'BlogCtrl.php';

class ArticleCtrl extends BlogCtrl {

	public function index() {
		$aid = $this->request->aid;

		//读取文章
		$article = $this->db("##_article")->where("`id`=" . $aid." and type='post'")->find();

		if (!$article)
			throw new JprassException("您访问的文章不存在！", 404);

		$article['content'] = JPrassApi::ubbDecode(htmlspecialchars_decode($article['content']));

		//读取文章分类
		$category = $this->db("##_category")->field('id,catename')->where("t.id in (select cate_id from ##_article_cate where aid='" . $article['id'] . "')")->findAll();
		$article['category'] = $category;

		//加载文章标签
		$article['tags'] = $this->db("##_article_tag")->field("a.tagname,a.id")->join("##_tag", "a on a.id=t.tagid")->where("a.id <>'' and t.aid=" . $article['id'])->findAll();

		//更新文章点击量
		$this->db("##_article")->where("`id`=" . $aid)->update(array("views" => $article['views'] + 1));

		//加载文章评论
		$comments = $this->db("##_comment")->field("t.*")->order("t.dateline asc")->where("t.`ischeck`=1 and t.aid=" . $aid)->findAll();
		$this->assign("comments", $comments);

		//设置页面标题关键词及描述
		$this->assign("title", $article['title']);

		//组织页面关键字
		$keywords = "";
		if ($article['tags'] && count($article['tags'])) {
			foreach ($article['tags'] as $key => $tag) {
				if ($key > 0)
					$keywords.="," . $tag['tagname'];
				else
					$keywords.=$tag['tagname'];
			}
			$this->assign("keywords", $keywords);
		}
		$this->assign("description", $article['description']);

		$this->assign("article", $article);
		return $this->theme . '/article';
	}

}
?>
