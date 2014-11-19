<?php

/*
 * FileName UserCtrl.class.php 
 * Date     2013-9-14  21:50:46
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require_once("AdminBaseCtrl.php");

class UserCtrl extends AdminBaseCtrl {

	public function index() {
		$p = StringFilter::val($this->request->p)->filter('int');

		$data = $this->db("##_user")->findPage($p, 15);
		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));

		return "user/main";
	}

	public function _get_add() {
		return "user/add";
	}

	public function _post_add() {
		$data['login_name'] = trim(strtolower($this->request->loginName));
		$data['login_pwd'] = $this->request->loginPwd;
		$repwd = $this->request->reloginPwd;
		$data['screen_name'] = $this->request->screenName;
		$data['email'] = $this->request->email;
		$data['enable'] = 'Y';
		if (!preg_match("/^\w{3,12}$/i", $data['login_name'])) {
			$this->notice("用户名不符合规则，只能是3-12位数字、字母、下划线！",'error');
			JPrassApi::redirect(-1);
		}
		if (!preg_match("/^[0-9a-zA-Z]{6,16}$/i", $data['login_pwd'])) {
			$this->notice("密码格式不合法，请输入6-16位数字、字母组成",'error');
			JPrassApi::redirect(-1);
		}
		if ($data['login_pwd'] != $repwd) {
			$this->notice("密码与确认密码不一致！",'error');
			JPrassApi::redirect(-1);
		}
		if (!empty($data['email']) && !preg_match("/^(?:[a-z0-9]+[_\-+.]?)*[a-z0-9]+@(?:([a-z0-9]+-?)*[a-z0-9]+.)+([a-z]{2,})+$/i", $data['email'])) {
			$this->notice("您输入的邮箱不符合规则",'error');
			JPrassApi::redirect(-1);
		}
		if (empty($data['screen_name'])) {
			$data['screen_name'] = $data['login_name'];
		}
		$data[login_pwd] = md5($data['login_name'] . $data['login_pwd']);
		$user = $this->db("##_user")->where("login_name='" . $data['login_name'] . "'")->find();
		if ($user) {
			$this->notice("用户名已经存在，更换用户名再试！",'error');
			JPrassApi::redirect(-1);
		}
		$id = $this->db("##_user")->add($data);
		if ($id) {
			$this->notice("添加用户成功！");
			JPrassApi::redirect('index.php?c=user');
		} else {
			$this->notice("系统忙，请稍后再试",'error');
			JPrassApi::redirect(-1);
		}
	}

	public function _get_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');
		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！",'error');
			JPrassApi::redirect(-1);
		}
		$user = $this->db('##_user')->find("id=" . $id);

		$this->assign("user", $user);

		return "user/edit";
	}

	public function _post_edit() {
		$id = StringFilter::val($this->request->id)->filter('int');
		$data['login_pwd'] = $this->request->loginPwd;
		$repwd = $this->request->reloginPwd;
		$data['screen_name'] = $this->request->screenName;
		$data['email'] = $this->request->email;
		$data['enable'] = 'Y';
		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！",'error');
			JPrassApi::redirect(-1);
		}

		if (empty($data['screen_name'])) {
			$this->notice("昵称不能为空！",'error');
			JPrassApi::redirect(-1);
		}

		if (!empty($data['login_pwd'])) {
			if (strlen($data['login_pwd']) < 6) {
				$this->notice("密码长度不能小于6",'error');
				JPrassApi::redirect(-1);
			}
			if ($data['login_pwd'] != $repwd) {
				$this->notice("密码与确认密码不一致！",'error');
				JPrassApi::redirect(-1);
			}
			$user = $this->db("##_user")->field("t.login_name")->where("`id` = " . $id)->find();
			$data['login_pwd'] = md5($user['login_name'] . $data['login_pwd']);
		} else {
			unset($data['login_pwd']);
		}

		if (!empty($data['email']) && !preg_match("/^(?:[a-z0-9]+[_\-+.]?)*[a-z0-9]+@(?:([a-z0-9]+-?)*[a-z0-9]+.)+([a-z]{2,})+$/i", $data['email'])) {
			$this->notice("您输入的邮箱不符合规则",'error');
			JPrassApi::redirect(-1);
		}



		$res = $this->db("##_user")->where("`id`=" . $id)->update($data);
		if ($res) {
			$this->notice( "修改用户成功！");
			JPrassApi::redirect("index.php?c=user");
		} else {
			$this->notice("系统忙，请稍后再试",'error');
			JPrassApi::redirect(-1);
		}
	}

	function _post_enable() {
		return $this->changeEnable("Y");
	}

	function _post_disable() {
		return $this->changeEnable("N");
	}

	private function changeEnable($enable) {
		$ids = $this->request->ids;

		if (empty($ids)) {
			return array("state" => false, "message" => "请选择您需要操作的记录");
		}
		if (!preg_match("/^([0-9,]+)+$/i", $ids) || !preg_match("/^[Y|N]$/i", $enable)) {
			return array("state" => false, "message" => "参数错误！请刷新页面再试");
		}

		$res = $this->db("##_user")->where("id in (" . $ids . ")")->update(array("enable" => $enable));
		if ($res) {
			return array("state" => true, "message" => "恭喜！执行成功！", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

}

?>
