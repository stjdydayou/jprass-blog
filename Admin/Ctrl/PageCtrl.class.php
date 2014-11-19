<?php

/*
 * FileName PageCtrl.class.php 
 * Date     2013-10-17  16:31:28
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class PageCtrl extends AdminBaseCtrl {

	private $arrayImageExt = array('*.gif', '*.jpg', '*.png', '*.tiff', '*.bmp');
	private $arrayMediaExt = array('*.mp3', '*.wmv', '*.wma', '*.rmvb', '*.rm', '*.avi', '*.flv');
	private $arrayDocExt = array('*.txt', '*.doc', '*.docx', '*.xls', '*.xlsx', '*.ppt', '*.pptx', '*.zip', '*.rar', '*.pdf');

	public function index() {
		$p = StringFilter::val($this->request->p)->filter("int");

		$db = $this->db("##_article");
		$where = "t.type='page'";

		$field = "t.id,t.title,t.views,t.dateline,t.status,a.comments";
		$join = "(select count(1) comments,aid from ##_comment group by aid) a on a.aid = t.id";

		$data = $db->field($field)->where($where)->order("dateline desc")->join($join)->findPage($p, 15);

		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));

		return "page/index";
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
			$this->db("##_article")->where("id in (" . $ids . ")")->delete();
			$this->db("##_article_tag")->where("aid in (" . $ids . ")")->delete();

			$this->db()->commit();
			return array("state" => true, "message" => "恭喜！删除成功！", "needRefresh" => true);
		} catch (Exception $exp) {
			$exp->getMessage();
			$this->db()->rollback();
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

	public function _get_add() {
		//附件上传参数
		$uploadConf = JPrassApi::C("upload");

		$extArr = array();
		if (strval($uploadConf['file_ext_image']) == 'true')
			$extArr = array_merge($extArr, $this->arrayImageExt);

		if (strval($uploadConf['file_ext_media']) == 'true')
			$extArr = array_merge($extArr, $this->arrayMediaExt);

		if (strval($uploadConf['file_ext_doc']) == 'true')
			$extArr = array_merge($extArr, $this->arrayDocExt);

		if (!empty($uploadConf['file_ext_other']))
			$extArr = array_merge($extArr, split(",", $uploadConf['file_ext_other']));
		$this->assign("extArr", implode(";", $extArr));
		$this->assign("maxSize", intval($uploadConf["max_size"]) . ' KB');

		$listCate = $this->db("##_category")->field("id,catename")->order("id asc")->findAll();
		$this->assign("listCate", $listCate);
		return "page/add";
	}

	public function _post_add() {
		try {
			$page = $this->builderPage();
			$tags = $page['tags'];
			unset($page['tags']);

			$uploads = $page['upload'];
			unset($page['upload']);
//			print_r($page);
//			exit();
			//开启事务
			$this->db()->transaction();

			//保存文章主体
			$this->db("##_article")->add($page);

			//获取文章被入的ID
			$arcid = $this->db()->insertId();

			if (is_array($tags) && count($tags)) {
				//保存标签内容
				foreach ($tags as $tagid) {
					$this->db("##_article_tag")->add(array("id" => $arcid . $tagid, "aid" => $arcid, "tagid" => $tagid));
				}
			}

			//添加附件关联
			if (is_array($uploads) && count($uploads)) {
				foreach ($uploads as $value) {
					$this->db("##_upload")->where("id='{$value}'")->update(array('aid' => $arcid));
				}
			}

			$this->db()->commit();
			$this->notice("添加文章成功");
		} catch (Exception $exp) {
			$this->db()->rollback();
			$this->notice("系统忙，请稍后再试！" . $exp->getMessage(), "error");
		}
		JPrassApi::redirect('index.php?app=admin&c=page');
	}

	public function _get_edit() {
		$id = StringFilter::val($this->request->id)->filter("int");

		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！", 'error');
			JPrassApi::redirect(-1);
		}

		$listCate = $this->db("##_category")->field("id,catename")->order("id asc")->findAll();
		$this->assign("listCate", $listCate);

		$page = $this->db("##_article")->find("id=" . $id);
		if (!$page) {
			$this->notice("您修改的文章不存在！", 'error');
			JPrassApi::redirect(-1);
		}

		//处理标签
		$tags = $this->db("##_article_tag")->field("a.tagname")->join("##_tag", "a on a.id=t.tagid")->where("a.tagname <>'' and t.aid=" . $page['id'])->findAll();
		$_tags = array();
		foreach ($tags as $key => $tag) {
			$_tags[$key] = $tag['tagname'];
		}
		$page['tags'] = implode(",", $_tags);

		//读取当前文章所关联的附件
		$page['upload'] = array();
		$uploads = $this->db("##_upload")->field('id,originalname,filepath,fileext')->where("t.aid ='" . $page['id'] . "'")->findAll();
		foreach ($uploads as $val) {
			$val['isImage'] = in_array($val['fileext'], array('jpg', 'jpeg', 'gif', 'png', 'tiff', 'bmp')) ? 'true' : 'false';
			$page['upload'][] = $val;
		}

		$this->assign("page", $page);

		//附件上传参数
		$uploadConf = JPrassApi::C("upload");
		$extArr = array();
		if (strval($uploadConf['file_ext_image']) == 'true')
			$extArr = array_merge($extArr, $this->arrayImageExt);

		if (strval($uploadConf['file_ext_media']) == 'true')
			$extArr = array_merge($extArr, $this->arrayMediaExt);

		if (strval($uploadConf['file_ext_doc']) == 'true')
			$extArr = array_merge($extArr, $this->arrayDocExt);

		if (!empty($uploadConf['file_ext_other']))
			$extArr = array_merge($extArr, split(",", $uploadConf['file_ext_other']));

		$this->assign("extArr", implode(";", $extArr));
		$this->assign("maxSize", intval($uploadConf["max_size"]) . ' KB');
		return "page/edit";
	}

	public function _post_edit() {
		try {
			$arcid = StringFilter::val($this->request->arcid)->filter("int");

			if (!$arcid) {
				$this->notice("参数错误，请刷新页面后再试！");
				JPrassApi::redirect(-1);
			}
			$page = $this->builderPage();

			$tags = $page['tags'];
			unset($page['tags']);


			$uploads = $page['upload'];
			unset($page['upload']);

			//保存文章主体
			$this->db()->transaction();
			$this->db("##_article")->where("`id`=" . $arcid)->update($page);

			//删除文章原有的标签内容
			$this->db("##_article_tag")->where("aid=" . $arcid)->delete();
			//保存标签内容
			foreach ($tags as $tagid) {
				$this->db("##_article_tag")->add(array("id" => $arcid . $tagid, "aid" => $arcid, "tagid" => $tagid));
			}

			//添加附件关联
			if (is_array($uploads) && count($uploads)) {
				foreach ($uploads as $value) {
					$this->db("##_upload")->where("id='{$value}'")->update(array('aid' => $arcid));
				}
			}

			$this->db()->commit();
			$this->notice("修改页面成功");
		} catch (Exception $exp) {
			$this->db()->rollback();
			$this->notice("系统忙，请稍后再试！" . $exp->getMessage(), 'error');
		}
		JPrassApi::redirect('index.php?app=admin&c=page');
	}

	private function builderPage() {
		$page['uid'] = $this->loginUser['id'];
		$page['title'] = $this->request->title;
		$page['upload'] = $this->request->upload;
		$page['status'] = StringFilter::val($this->request->status)->filter('int');

		if (empty($page['status']))
			$page['status'] = 1;

		$page['dateline'] = time();

		$tags = StringFilter::val($this->request->tags)->filter("xss");
		$page['tags'] = $this->processTags($tags);

		$page['description'] = StringFilter::val($this->request->description)->filter("text");
		$page['content'] = $this->request->content;
		$page['type'] = 'page';
		if (empty($page['title']))
			$page['title'] = '未命名文档';

		if (empty($page['description']))
			$page['description'] = $page['content'];

		$page['content'] = htmlspecialchars(addslashes($page['content']));
		$page['description'] = StringFilter::val($page['description'])->filter("text");
		return $page;
	}

	function processTags($tags) {
		if (empty($tags))
			return '';

		$tagsid = array();
		$tags = explode(',', $tags);
		foreach ($tags as $tag) {
			if (empty($tag))
				continue;

			$dbtag = $this->db("##_tag")->field("id,tagname")->where("tagname = '" . $tag . "'")->find();
			if ($dbtag) {
				$tagsid[] = $dbtag['id'];
			} else {
				$this->db("##_tag")->add(array("tagname" => $tag, "count" => 1));
				$tagsid[] = $this->db()->insertId();
			}
		}
		return $tagsid;
	}

}

?>