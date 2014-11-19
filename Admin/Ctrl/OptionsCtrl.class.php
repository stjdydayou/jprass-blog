<?php

/*
 * FileName OptionsCtrl.class.php 
 * Date     2013-9-19  20:42:37
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class OptionsCtrl extends AdminBaseCtrl {

	public function _get_index() {
		$options = $this->getOptions("blog");
		$this->assign("options", $options);
		return "options/main";
	}

	public function _post_index() {
		$this->saveOptions("blog");
		JPrassApi::redirect("index.php?c=options");
	}

	public function _get_upload() {
		$options = $this->getOptions("upload");
		$this->assign("options", $options);
		return "options/upload";
	}

	public function _post_upload() {
		if (!isset($this->request->file_ext_image) || $this->request->file_ext_image != 'true')
			$this->request->file_ext_image = 'false';

		if (!isset($this->request->file_ext_media) || $this->request->file_ext_media != 'true')
			$this->request->file_ext_media = 'false';

		if (!isset($this->request->file_ext_doc) || $this->request->file_ext_doc != 'true')
			$this->request->file_ext_doc = 'false';

		$this->saveOptions("upload");
		JPrassApi::redirect("index.php?c=options&a=upload");
	}

	public function _get_permalink() {
		$options = $this->getOptions("permalink");
		$this->assign("options", $options);
		return "options/permalink";
	}

	public function _post_permalink() {
		$this->saveOptions("permalink");
		JPrassApi::redirect("index.php?c=options&a=permalink");
	}

	private function saveOptions($type) {
		try {
			$this->db()->transaction();
			$rows = $this->db("##_options")->field("t.`name`")->where("`type`='" . $type . "'")->findAll();
			foreach ($rows as $v) {
				if (isset($this->request->$v['name'])) {
					$val = htmlspecialchars($this->request->$v['name']);
					$this->db("##_options")->where("t.`name`='" . $v['name'] . "' and t.type='" . $type . "'")->update(array("value" => $val));
				}
			}
			$this->db()->commit();
			$this->cacheOptions($type);
			$this->notice("恭喜！更新配置成功！");
		} catch (Exception $exp) {
			$this->db()->rollback();
			$this->notice("系统忙，请稍后再试！");
		}
	}

	private function getOptions($type) {
		$options = array();
		$rows = $this->db("##_options")->field("t.`name`,t.`value`")->where("`type`='" . $type . "'")->findAll();
		foreach ($rows as $v) {
			$options[$v['name']] = htmlspecialchars_decode($v['value']);
		}
		return $options;
	}

	private function cacheOptions() {
		$options = array();
		$rows = $this->db("##_options")->field("t.`name`,t.`value`,t.`type`")->findAll();
		foreach ($rows as $row) {
			$options[$row['type']][$row['name']] = $row['value'];
		}

		if (is_array($options)) {
			$content = var_export($options, True);
		}
		$content = "<?php\n//该文件是系统自动生成的缓存文件，请勿修改\n//创建时间：" . date('Y-m-d H:i:s', time()) . "\n\nif (!defined('__JPRASS_RUNTIME_PATH__')) {exit('Access Denied!');}\n\n return " . $content . "\n\n?>";
		$filename = __JPRASS_RUNTIME_PATH__ . '/Option.php';
		@file_put_contents($filename, $content);
		@chmod($filename, 0777);
	}

}

?>
