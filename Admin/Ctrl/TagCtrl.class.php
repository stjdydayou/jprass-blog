<?php

/*
 * FileName TagCtrl.class.php 
 * Date     2013-9-16  22:43:45
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class TagCtrl extends AdminBaseCtrl {

	public function index() {
		$p = StringFilter::val($this->request->p)->filter('int');

		$join = "(select count(1) arcnum,tagid from ##_article_tag group by tagid) a on a.tagid = t.id";
		$data = $this->db("##_tag")->field("t.*,a.arcnum")->join($join)->order("a.arcnum desc")->findPage($p, 15);
		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));

		return "tag/main";
	}

	public function _post_delete() {

		$ids = $this->request->ids;
		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		if (!preg_match("/^([0-9,]+)+$/i", $ids)) {
			return array("state" => false, "message" => "参数错误！请刷新页面再试");
		}
		try {
			$this->db()->transaction();
			$this->db("##_tag")->where("id in (" . $ids . ")")->delete();
			$this->db("##_article_tag")->where("tagid in (" . $ids . ")")->delete();
			$this->db()->commit();
			return array("state" => true, "message" => "恭喜！删除成功！", "needRefresh" => true);
		} catch (Exception $exp) {
			unset($exp);
			$this->db()->rollback();
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

}

?>
