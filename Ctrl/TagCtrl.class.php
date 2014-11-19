<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	TagCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once 'BlogCtrl.php';

class TagCtrl extends BlogCtrl {

	public function index() {
		$tagid = $this->request->tagid;
		$p = $this->request->p;

		if (isset($tagid) && !empty($tagid)) {

			$tag = $this->db('##_tag')->find("id=" . $tagid);

			if (!$tag)
				throw new JprassException("您访问的标签内容不存在！", 404);

			$where=" t.id in (select aid from ##_article_tag where tagid='$tagid')";

			$data = $this->listArticle($where, $p);

			$pager = $this->buildPager($data, "tag", $tagid);

			$this->assign("pager", $pager);

			$this->assign("title", "TAG:" . $tag['tagname']);

			return $this->theme . '/list';
		} else {
			 $db = $this->db("##_tag");

			$db->field("t.*,a.arcnum");
			$db->join("(select count(1) arcnum,tagid from ##_article_tag group by tagid) a on a.tagid = t.id");
			$list = $db->order("a.arcnum desc")->findAll();

			$this->assign("list", $list);

			$this->assign("title", "标签云集");

			return $this->theme . '/tag';
		}
	}

}

?>
