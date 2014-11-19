<?php

/*
 * FileName ArticleCtrl.class.php 
 * Date     2013-9-16  21:31:28
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class ArticleCtrl extends AdminBaseCtrl {

	private $arrayImageExt = array('*.gif', '*.jpg', '*.png', '*.tiff', '*.bmp');
	private $arrayMediaExt = array('*.mp3', '*.wmv', '*.wma', '*.rmvb', '*.rm', '*.avi', '*.flv');
	private $arrayDocExt = array('*.txt', '*.doc', '*.docx', '*.xls', '*.xlsx', '*.ppt', '*.pptx', '*.zip', '*.rar', '*.pdf');

	public function index() {
		$p = StringFilter::val($this->request->p)->filter("int");

		$sKey = StringFilter::val($this->request->s_key)->filter("search");
		$sCate = StringFilter::val($this->request->s_cate)->filter("int");
		$this->assign("sKey", $sKey);
		$this->assign("sCate", $sCate);
		
		$dbArticle = $this->db("##_article");
		$where = "t.type='post'";
		if (!empty($sKey)) {
			$where .=" and t.title like '%" . $sKey . "%'";
		}
		if ($sCate) {
			$where .=" and t.id in (select aid from ##_article_cate where cate_id='" . $sCate . "')";
		}
		$field = "t.id,t.title,t.views,t.dateline,t.status,a.comments";
		$join = "(select count(1) comments,aid from ##_comment group by aid) a on a.aid = t.id";

		$data = $dbArticle->field($field)->where($where)->order("dateline desc")->join($join)->findPage($p, 15);

		//读取文章分类
		foreach ($data['records'] as $key => $val) {
			$data['records'][$key]['category'] = $this->db("##_category")->field('id,catename')->where("t.id in (select cate_id from ##_article_cate where aid='" . $val['id'] . "')")->findAll();
		}

		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));

		$listCate = $this->db("##_category")->field("id,catename")->order("id asc")->findAll();

		$this->assign("listCate", $listCate);

		return "article/index";
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
			$this->db("##_article_cate")->where("aid in (" . $ids . ")")->delete();

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

		if (!empty($uploadConf['file_ext_other'])){
			$_arr = split(",", $uploadConf['file_ext_other']);
			foreach($_arr as $k=>$v){
				$_arr[$k] = "*.".$v;
			}
			$extArr = array_merge($extArr, $_arr);
		}
		$this->assign("extArr", implode(";", $extArr));
		$this->assign("maxSize", intval($uploadConf["max_size"]) . ' KB');

		$listCate = $this->db("##_category")->field("id,catename")->order("id asc")->findAll();
		$this->assign("listCate", $listCate);
		return "article/add";
	}

	public function _post_add() {
		try {
			$article = $this->builderArticle();
			$tags = $article['tags'];
			unset($article['tags']);

			$cates = $article['cid'];
			unset($article['cid']);

			$uploads = $article['upload'];
			unset($article['upload']);

			//开启事务
			$this->db()->transaction();

			//保存文章主体
			$this->db("##_article")->add($article);
			//获取文章被入的ID
			$arcid = $this->db()->insertId();

			//保存文章内容
			if (is_array($cates) && count($cates)) {
				foreach ($cates as $cateid) {
					$this->db("##_article_cate")->add(array("id" => $arcid . $cateid, "aid" => $arcid, "cate_id" => $cateid));
				}
			}

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
			JPrassApi::redirect('index.php?app=admin&c=article');
		} catch (Exception $exp) {
			//exit($exp->getMessage());
			$this->db()->rollback();
			$this->notice("系统忙，请稍后再试！" . $exp->getMessage(), "error");
		}
	}

	public function _get_edit() {
		$id = StringFilter::val($this->request->id)->filter("int");

		if (!$id) {
			$this->notice("参数错误，请刷新页面后再试！", 'error');
			JPrassApi::redirect(-1);
		}

		$listCate = $this->db("##_category")->field("id,catename")->order("id asc")->findAll();
		$this->assign("listCate", $listCate);

		$article = $this->db("##_article")->find("id=" . $id);
		if (!$article) {
			$this->notice("您修改的文章不存在！", 'error');
			JPrassApi::redirect(-1);
		}
		//处理标签
		$tags = $this->db("##_article_tag")->field("a.tagname")->join("##_tag", "a on a.id=t.tagid")->where("a.tagname <>'' and t.aid=" . $article['id'])->findAll();
		$_tags = array();
		foreach ($tags as $key => $tag) {
			$_tags[$key] = $tag['tagname'];
		}
		$article['tags'] = implode(",", $_tags);

		//获取当前文章所拥有的分类
		$article['category'] = array();
		$category = $this->db("##_category")->field('id')->where("t.id in (select cate_id from ##_article_cate where aid='" . $article['id'] . "')")->findAll();
		foreach ($category as $val) {
			$article['category'][] = $val['id'];
		}

		//读取当前文章所关联的附件
		$article['upload'] = array();
		$uploads = $this->db("##_upload")->field('id,originalname,filepath,fileext')->where("t.aid ='" . $article['id'] . "'")->findAll();
		foreach ($uploads as $val) {
			$val['isImage'] = in_array($val['fileext'], array('jpg', 'jpeg', 'gif', 'png', 'tiff', 'bmp')) ? 'true' : 'false';
			$article['upload'][] = $val;
		}
		$this->assign("article", $article);
		
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
		return "article/edit";
	}

	public function _post_edit() {
		try {
			$arcid = StringFilter::val($this->request->arcid)->filter("int");

			if (!$arcid) {
				$this->notice("参数错误，请刷新页面后再试！");
				JPrassApi::redirect(-1);
			}
			$article = $this->builderArticle();

			$tags = $article['tags'];
			unset($article['tags']);

			$cates = $article['cid'];
			unset($article['cid']);

			$uploads = $article['upload'];
			unset($article['upload']);

			//保存文章主体
			$this->db()->transaction();
			$this->db("##_article")->where("`id`=" . $arcid)->update($article);

			//删除文章原有的分类内容
			$this->db("##_article_cate")->where("aid=" . $arcid)->delete();
			//保存标签内容
			foreach ($cates as $cateid) {
				$this->db("##_article_cate")->add(array("id" => $arcid . $cateid, "aid" => $arcid, "cate_id" => $cateid));
			}

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
			$this->notice("修改文章成功");
			JPrassApi::redirect('index.php?app=admin&c=article');
		} catch (Exception $exp) {
			$this->db()->rollback();
			$this->notice("系统忙，请稍后再试！" . $exp->getMessage());
			JPrassApi::redirect('index.php?app=admin&c=article', 'error');
		}
	}

	private function builderArticle() {
		$article['uid'] = $this->loginUser['id'];
		$article['title'] = $this->request->title;
		$article['cid'] = $this->request->cid;
		$article['upload'] = $this->request->upload;
		$article['status'] = StringFilter::val($this->request->status)->filter('int');

		if (empty($article['status']))
			$article['status'] = 1;

		$timestr = StringFilter::val($this->request->_year)->filter('int');
		$timestr .= "-" . StringFilter::val($this->request->_month)->filter('int');
		$timestr .= "-" . StringFilter::val($this->request->_day)->filter('int');
		$timestr .= " " . StringFilter::val($this->request->_hour)->filter('int');
		$timestr .= ":" . StringFilter::val($this->request->_min)->filter('int');
		$timestr .= ":" . date('s', time());

		$article['dateline'] = strtotime($timestr);

		$tags = StringFilter::val($this->request->tags)->filter("xss");
		$article['tags'] = $this->processTags($tags);



		$article['from'] = StringFilter::val($this->request->from)->filter("xss");
		$article['fromurl'] = StringFilter::val($this->request->fromurl)->filter("url");
		$article['description'] = StringFilter::val($this->request->description)->filter("text");
		$article['content'] = $this->request->content;
		$article['type'] = 'post';
		if (empty($article['title']))
			$article['title'] = '未命名文档';

		if (!$article['cid'] || count($article['cid']) <= 0)
			$article['cid'] = array(JPrassApi::C("blog.default_category"));

		if (empty($article['description']))
			$article['description'] = $article['content'];

		$article['content'] = htmlspecialchars(addslashes($article['content']));
		$article['description'] = StringFilter::val($article['description'])->filter("text");
		return $article;
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
				$this->db("##_tag")->add(array("tagname" => $tag));
				$tagsid[] = $this->db()->insertId();
			}
		}
		return $tagsid;
	}

}
?>