<?php

/*JPrass Blog
 * 
 * FileName MainCtrl.class.php 
 * Date     2013-9-01  15:47:53
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require_once 'BlogCtrl.php';

class MainCtrl extends BlogCtrl {

	public function index() {
		
		$this->assign("title", "首页");
		
		$data = $this->listArticle("1=1", 1);
		
		$pager = $this->buildPager($data, "category", 0);
		
		$this->assign("pager", $pager);
		
		return $this->theme."/list";
		
	}
}

?>