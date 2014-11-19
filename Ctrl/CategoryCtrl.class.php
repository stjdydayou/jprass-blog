<?php

/**
 * JPrass Blog
 * 文章分类页面
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	CategoryCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once 'BlogCtrl.php';

class CategoryCtrl extends BlogCtrl {

	public function index() {

		$this->assign("method", "category");

		$cid = $this->request->cid;
		$p = $this->request->p;
		if(!$p || $p<=0) $p=1;
		if(empty($cid) || !is_numeric($cid)) $cid = 0;
		
		//页面标题
		$title = "";
		$where = "1=1";
		
		if (is_numeric($cid) && $cid > 0) {
			$where.=" and t.id in (select aid from ##_article_cate where cate_id='" . $cid . "')";
			$category = $this->db("##_category")->find("id=" . $cid);
			
			if(!$category)
				throw new JprassException("您访问的内容不存在！",404);
			$title = $category['catename'];
			$this->assign("keywords", $category['keywords']);
			$this->assign("description", $category['description']);
		}else{
			$title = "所有文章";
		}
		
		if($p>1) $title.="-第{$p}页";
		
		$this->assign("title", $title);
		
		$data = $this->listArticle($where, $p);

		$pager = $this->buildPager($data, "category", $cid);

		$this->assign("pager", $pager);

		return $this->theme . "/list";
	}

}

?>
