<?php

/*
 * FileName FlinkCtrl.class.php 
 * Date     2013-9-16  22:50:01
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class FlinkCtrl extends AdminBaseCtrl {

	public function index() {
		$p = StringFilter::val($this->request->p)->filter('int');

		$visible = strval($this->request->s_visible);
		$where = "1=1";
		if ($visible != '') {
			$where.=" and t.`visible`='".$visible."'";
		}

		$sKey = StringFilter::val($this->request->s_key)->filter('search');
		if (!empty($sKey)) {
			$where.=" AND (t.name LIKE '%" . $sKey . "%' OR t.url LIKE '%" . $sKey . "%')";
		}

		$data = $this->db("##_flink")->where($where)->order("id desc")->findPage($p, 15);

		$this->assign("sKey", $sKey);
		$this->assign("visible", $visible);

		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));
		return "flink/main";
	}

	public function _get_add() {
		return "flink/add";
	}

	public function _post_add() {
		$flink = array(
			'name' => $this->request->name,
			'url' => StringFilter::val($this->request->url)->filter('url'),
			'logo' => StringFilter::val($this->request->logo)->filter('url'),
			'description' => $this->request->description,
			'visible' => $this->request->visible
		);
		if (empty($flink['name']) || empty($flink['url'])) {
			$this->notice("链接各和地址不能为空！", "error");
			JPrassApi::redirect(-1);
		}

		$res = $this->db("##_flink")->add($flink);

		if ($res) {
			$this->notice("恭喜！成功添加" . $this->db()->affectedRows() . "条链接！");
			JPrassApi::redirect("index.php?c=flink");
		} else {
			$this->notice("系统忙，请稍后再试", 'error');
			JPrassApi::redirect(-1);
		}
	}

	public function _get_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');

		if (empty($id)) {
			$this->notice("参数错误！请刷新页面再试！");
			JPrassApi::redirect(-1);
		}

		$flink = $this->db('##_flink')->where("id =" . $id)->find();

		if (!$flink) {
			$this->notice("您修改的记录不存在！请刷新页面再试！");
			JPrassApi::redirect(-1);
		}

		$this->assign("flink", $flink);

		return "flink/edit";
	}

	public function _post_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');

		if (empty($id)) {
			$this->notice("参数错误！请刷新页面再试！");
			JPrassApi::redirect(-1);
		}

		$flink = array(
			'name' => $this->request->name,
			'url' => StringFilter::val($this->request->url)->filter('url'),
			'logo' => StringFilter::val($this->request->logo)->filter('url'),
			'description' => $this->request->description,
			'visible' => $this->request->visible
		);

		if (empty($flink['name']) || empty($flink['url'])) {
			$this->notice("链接各和地址不能为空！", "error");
			JPrassApi::redirect(-1);
		}

		$res = $this->db('##_flink')->where("id =" . $id)->update($flink);

		if ($res) {
			$this->notice("恭喜！成功修改" . $this->db()->affectedRows() . "条记录！");
			JPrassApi::redirect("index.php?c=flink");
		} else {
			$this->notice("系统忙，请稍后再试", 'error');
			JPrassApi::redirect(-1);
		}
	}

	public function _post_delete() {
		$ids = $this->request->ids;

		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		if (!preg_match("/^([0-9,]+)+$/i", $ids)) {
			return array("state" => false, "message" => "参数错误！请刷新页面再试");
		}
		$res = $this->db("##_flink")->where("id in (" . $ids . ")")->delete();
		if ($res) {
			return array("state" => true, "message" => "恭喜！成功删除" . $this->db()->affectedRows() . "条记录！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

}

?>
