<?php

/*
 * FileName MainCtrl.class.php 
 * Date     2013-9-01  15:47:53
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */

require_once("AdminBaseCtrl.php");

class MainCtrl extends AdminBaseCtrl {

	public function index() {
		$this->assign("articleCount", $this->db("##_article")->where("type='post'")->count());
		$this->assign("commentCount", $this->db("##_comment")->count());
		$this->assign("categoryCount", $this->db("##_category")->count());
		$this->assign("uploadCount", $this->db("##_upload")->count());
		$this->assign("flinkCount", $this->db("##_flink")->count());
		$this->assign("listArticle", $this->db("##_article")->field("t.id,t.title,t.views,t.dateline,t.status")->where("type='post'")->order("t.dateline desc")->limit("0", "12")->findAll());

		$sysinfo['environment'] = $_SERVER['SERVER_SOFTWARE'];
		$sysinfo['mysql_version'] = mysql_get_server_info();
		$sysinfo['gd'] = $this->gdVersion();
		$sysinfo['register_globals'] = $this->transferPhpInfo("register_globals");
		$sysinfo['safe_mode'] = $this->transferPhpInfo("safe_mode");
		$sysinfo['allow_upload_size'] = $this->allowUploadSize();
		$sysinfo['memory'] = $this->memory();

		$this->assign("sysinfo", $sysinfo);
		return "index";
	}

	public function logout() {
		unset($_SESSION['login_user_session_key']);
		JPrassApi::redirect("index.php?c=login");
	}

	//获取Gd库的版本号
	private function gdVersion() {
		if (function_exists('gd_info')) {
			$gd = gd_info();
			return $gd['GD Version'] ? $gd['GD Version'] : "不支持";
		} else {
			return "没有开启GD";
		}
	}

	//转换变量的值 ON or OFF
	private function transferPhpInfo($val) {
		switch ($result = ini_get($val)) {
			case 0:
				return "OFF";
				break;
			case 1:
				return "ON";
				break;
			default:
				return $result;
				break;
		}
	}

	//转换字节
	private function memory() {
		$size = memory_get_usage();
		$Kb = 1024;
		$Mb = $Kb * 1024;
		$Gb = $Mb * 1024;
		$Tb = $Gb * 1024;
		if ($size < $Kb) {
			return $size . "Byte";
		} else if ($size < $Mb) {
			return round($size / $Kb, 2) . "KB";
		} else if ($size < $Gb) {
			return round($size / $Mb, 2) . "MB";
		} else if ($size < $Tb) {
			return round($size / $Gb, 2) . "GB";
		} else {
			return round($size / $Tb, 2);
		}
	}

	private function allowUploadSize() {
		if (@ini_get('file_uploads')) {
			return ini_get('upload_max_filesize');
		} else {
			return false;
		}
	}

}

?>