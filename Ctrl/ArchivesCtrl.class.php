<?php

/**
 * JPrass Blog
 * 文章归档
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	ArchivesCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
require_once 'BlogCtrl.php';

class ArchivesCtrl extends BlogCtrl {

	public function index() {
		
		$years = $this->request->years;
		$p = $this->request->p;

		if (isset($years) && !empty($years)) {

			$where=" FROM_UNIXTIME(t.dateline,'%Y%m')=" . $years;

			$data = $this->listArticle($where, $p);

			$pager = $this->buildPager($data, "archives", $years);

			$this->assign("title", $years . "-文章归档");

			$this->assign("pager", $pager);

			return $this->theme . '/list';
			
		} else {

			$sql = $sql = "select a.year,a.years,count(1) arcnum,month from (select FROM_UNIXTIME(dateline,'%M') as month,FROM_UNIXTIME(dateline,'%Y' ) as year,FROM_UNIXTIME(dateline,'%Y%m') as years from ##_article where type='post') a group by a.year,a.years order by a.years desc";
			
			$res = $this->db()->findSqlAll($sql);
			
			$list = array();
			
			while (count($res) != 0) {
				
				$archive = array_shift($res);
				
				$archive['url'] = BlogRouter::buildUrl("archives", $archive['years']);
				
				$list[$archive['year']][$archive['month']] = $archive;
			}
			
			$this->assign("title", "文章归档");
			
			$this->assign("list", $list);
			
			return $this->theme . '/archives';
			
		}
	}

}

?>
