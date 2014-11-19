<?php

/*
 * FileName CommentCtrl.class.php 
 * Date     2013-9-16  22:56:02
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require_once("AdminBaseCtrl.php");

class CommentCtrl extends AdminBaseCtrl {

	public function index() {
		$p = StringFilter::val($this->request->p)->filter('int');

		$noCheckCount = $this->db('##_comment')->where("t.`ischeck`=0")->count();
		$ischeck = !isset($this->request->ischeck) || $this->request->ischeck == '' ? -1 : $this->request->ischeck;

		$where = "1=1";
		if ($ischeck != -1) {
			$where.=" and t.`ischeck`=" . $ischeck;
		}
		$sKey = trim(StringFilter::val($this->request->s_key)->filter("search"));

		if (!empty($sKey)) {
			$where.=" AND (t.content LIKE '%" . $sKey . "%' OR t.username LIKE '%" . $sKey . "%' OR t.email LIKE '%" . $sKey . "%')";
		}
		$data = $this->db('##_comment')->field("t.*,a.title arctitle,a.dateline arttime")->order("t.dateline desc")->where($where)->join("##_article", "a on a.id=t.aid")->findPage($p, 15);

		$this->assign("pager", $this->buildPager($data));
		$this->assign("records", $data['records']);

		$this->assign("noCheckCount", $noCheckCount);
		$this->assign("ischeck", $ischeck);
		$this->assign("sKey", $sKey);
		return "comment/main";
	}

	public function _post_delete() {
		$ids = $this->request->ids;
		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		if (!preg_match("/^([0-9,]+)+$/i", $ids)) {
			return array("state" => false, "message" => "参数错误！请刷新页面再试");
		}
		$res = $this->db("##_comment")->where("id in (" . $ids . ")")->delete();
		if ($res) {
			return array("state" => true, "message" => "恭喜！成功删除" . $this->db()->affectedRows() . "条记录！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

	public function _post_check() {
		$res = $this->doCheck(1);
		if ($res) {
			return array("state" => true, "message" => "恭喜！成功审核" . $this->db()->affectedRows() . "条记录！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

	public function _post_nocheck() {
		$res = $this->doCheck(0);
		if ($res) {
			return array("state" => true, "message" => "恭喜！成功取消审核" . $this->db()->affectedRows() . "条记录！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}
	public function _post_restrictedip() {
		$ids = $this->request->ids;
		$list = $this->db("##_comment")->field('ip')->where("id in (" . $ids . ")")->findAll();;
		$this->db()->transaction();
		try {
			foreach($list as $v){
				$ip = $v['ip'];
				$id = ip2long($ip);
				if ($id != -1 || $id !== FALSE) {
					$data=array(
						"id"=>  $id,
						'ip'=>$ip,
						'dateline'=>time()
					);
					$find = $this->db("##_restricted_ip")->find("id=$id");
					if(!$find)
						$this->db("##_restricted_ip")->add($data);
				}
			}
			$this->db()->commit();
			return array("state" => true, "message" => "添加限制IP成功","needRefresh" => true);
		} catch (Exception $exp) {
			$exp->getMessage();
			$this->db()->rollback();
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}
	
	private function doCheck($ischeck) {
		$ids = $this->request->ids;
		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		return $res = $this->db("##_comment")->where("id in (" . $ids . ")")->update(array("ischeck" => $ischeck));
	}

}

?>
