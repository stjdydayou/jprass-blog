<?php

/*
 * FileName CategoryCtrl.class.php 
 * Date     2013-9-16  20:47:07
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */

require_once("AdminBaseCtrl.php");

class CategoryCtrl extends AdminBaseCtrl {

	public function index() {
		$list = $this->db("##_category")->field("t.*,a.arcnum")->order("t.orderid")->join("(select count(1) arcnum,cate_id from ##_article_cate group by cate_id) a on a.cate_id = t.id")->findAll();
		$this->assign("list", $list);
		return "category/main";
	}

	public function _get_add() {
		return "category/add";
	}

	public function _post_add() {
		$data = array(
			"catename" => $this->request->catename,
			"keywords" => $this->request->keywords,
			"description" => $this->request->description,
			"ishide" => StringFilter::val($this->request->ishide)->filter("int"),
			"orderid" => StringFilter::val($this->request->orderid)->filter("int"),
		);
		if (empty($data['catename'])) {
			$this->notice("分类名称不能为空！");
			JPrassApi::redirect(-1);
		}

		if (empty($data['keywords']))
			$data['keywords'] = $data['catename'];
		if (empty($data['description']))
			$data['description'] = $data['catename'];

		$res = $this->db("##_category")->add($data);

		if ($res) {
			$this->notice("恭喜！成功添加" . $this->db()->affectedRows() . "个分类！");
		} else {
			$this->notice("系统忙，请稍后再试");
		}
		JPrassApi::redirect('index.php?c=category');
	}

	public function _get_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');
		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！");
			JPrassApi::redirect(-1);
		}

		$category = $this->db("##_category")->find("id=" . $id);
		if (!$category) {
			$this->notice("修改的分类不存在！");
			JPrassApi::redirect(-1);
		}
		$this->assign("category", $category);

		return "category/edit";
	}

	public function _post_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');
		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！");
			JPrassApi::redirect(-1);
		}

		$data = array(
			"catename" => $this->request->catename,
			"keywords" => $this->request->keywords,
			"description" => $this->request->description,
			"ishide" => StringFilter::val($this->request->ishide)->filter("int"),
			"orderid" => StringFilter::val($this->request->orderid)->filter("int"),
		);
		if (empty($data['catename'])) {
			$this->notice("分类名称不能为空！");
			JPrassApi::redirect(-1);
		}

		if (empty($data['keywords']))
			$data['keywords'] = $data['catename'];
		if (empty($data['description']))
			$data['description'] = $data['catename'];

		$res=$this->db("##_category")->where("id =" . $id)->update($data);

		if ($res) {
			$this->notice("恭喜！成功修改" . $this->db()->affectedRows() . "个分类！");
		} else {
			$this->notice("系统忙，请稍后再试");
		}
		JPrassApi::redirect('index.php?c=category');
	}

	public function _post_delete() {
		$ids = $this->request->ids;

		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		if (!preg_match("/^([0-9,]+)+$/i", $ids)) {
			return array("state" => false, "message" => "参数错误！请刷新页面再试");
		}
		$res = $this->db("##_category")->where("id in (" . $ids . ")")->delete();
		if ($res) {
			return array("state" => true, "message" => "恭喜！成功删除" . $this->db()->affectedRows() . "条记录！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

}

?>
