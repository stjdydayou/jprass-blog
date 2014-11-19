<?php

/*
 * FileName AttachmentCtrl.class.php 
 * Date     2013-9-16  23:15:41
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */
require 'AdminBaseCtrl.php';

class UploadCtrl extends AdminBaseCtrl {

	public function index() {
		$p = StringFilter::val($this->request->p)->filter('int');

		$data = $this->db("##_upload")->field('t.*,a.title arctitle,a.dateline arcdateline')->join('##_article', 'a on t.aid=a.id')->order("id desc")->findPage($p, 15);

		$this->assign("records", $data['records']);
		$this->assign("pager", $this->buildPager($data));

		return "upload/main";
	}

	public function _post_delete() {
		try {

			$ids = $this->request->ids;
			if (empty($ids)) {
				return array("state" => false, "message" => "请选择您需要操作的记录");
			}
			if (!preg_match("/^([0-9,]+)+$/i", $ids)) {
				return array("state" => false, "message" => "参数错误！请刷新页面再试");
			}
			$arrId = explode(",", $ids);
			$count = 0;
			$this->db()->transaction();
			if (count($arrId)) {
				foreach ($arrId as $id) {
					$upload = $this->db("##_upload")->where("`id`=" . intval($id))->find();
					if ($upload) {
						$filePath = __JPRASS_ROOT_DIR__ . "/" . $upload['filepath'];
						if (file_exists($filePath) && is_file($filePath)) {
							$res = @unlink($filePath);
							if (!$res)
								throw new JprassException("删除文件失败");
						}
						$this->db("##_upload")->where("`id`=" . intval($id))->delete();
					}
					$count++;
				}
			} else {
				return array("state" => false, "message" => "请选择您需要操作的记录");
			}
			$this->db()->commit();
			return array("state" => true, "message" => "恭喜！成功删除" . $count . "条记录！", "needRefresh" => true);
		} catch (Exception $exp) {
			unset($exp);
			$this->db()->rollback();
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

	public function handler() {
		//读取上传配置
		$config = JPrassApi::C("upload");
		$uploadName = "Filedata";

		//PHP上传失败
		if (!empty($_FILES[$uploadName]['error'])) {
			switch ($_FILES[$uploadName]['error']) {
				case '1':
					$error = '超过php.ini允许的大小。';
					break;
				case '2':
					$error = '超过表单允许的大小。';
					break;
				case '3':
					$error = '图片只有部分被上传。';
					break;
				case '4':
					$error = '请选择图片。';
					break;
				case '6':
					$error = '找不到临时目录。';
					break;
				case '7':
					$error = '写文件到硬盘出错。';
					break;
				case '8':
					$error = 'File upload stopped by extension。';
					break;
				case '999':
				default:
					$error = '未知错误。';
			}
			return array('error' => 1, "message" => $error);
		}

		//此目录是相对于网站的根目录
		$uploadDir = "upload/";

		//最大文件大小
		$max_size = intval($config["max_size"]) * 1024;
		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES[$uploadName]['name'];
			//服务器上临时文件名
			$tmpName = $_FILES[$uploadName]['tmp_name'];
			//文件大小
			$fileSize = $_FILES[$uploadName]['size'];
			//检查文件名
			if (!$file_name) {
				return array('error' => 2, "message" => "请选择文件。");
			}
			//检查目录
			if (@is_dir(__JPRASS_ROOT_DIR__ . '/' . $uploadDir) === false) {
				return array('error' => 3, "message" => "上传目录不存在。");
			}
			//检查目录写权限
			if (@is_writable(__JPRASS_ROOT_DIR__ . '/' . $uploadDir) === false) {
				return array('error' => 4, "message" => "上传目录没有写权限。");
			}
			//检查是否已上传
			if (@is_uploaded_file($tmpName) === false) {
				return array('error' => 5, "message" => "上传失败。");
			}
			//检查文件大小
			if ($fileSize > $max_size) {
				return array('error' => 6, "message" => "上传文件大小超过限制。");
			}
			
			//获得文件扩展名
			$_fileExplodeArr= explode(".", $file_name);
			if(count($_fileExplodeArr) > 0){
				$fileExt = strtolower(trim(array_pop($_fileExplodeArr)));
			}else{
				$fileExt="";
			}

			$arrayImageExt = array('gif','jpg','png','tiff','bmp');
			$arrayMediaExt = array('mp3','wmv','wma','rmvb','rm','avi','flv');
			$arrayDocExt = array('txt','doc','docx','xls','xlsx','ppt','pptx','zip','rar','pdf');
			//定义允许上传的文件扩展名
			$extArr = array();
			if (strval($config['file_ext_image']) == 'true')
				$extArr = array_merge($extArr, $arrayImageExt);

			if (strval($config['file_ext_media']) == 'true')
				$extArr = array_merge($extArr, $arrayMediaExt);

			if (strval($config['file_ext_doc']) == 'true')
				$extArr = array_merge($extArr, $arrayDocExt);

			if (!empty($config['file_ext_other']))
				$extArr = array_merge($extArr, split(",", $config['file_ext_other']));

			//检查扩展名
			if (!in_array($fileExt, $extArr)) {
				return array('error' => 8, "message" => $fileExt."上传文件扩展名是不允许的扩展名。".  implode(";", $extArr));
			}
			//创建文件夹
			$uploadDir .= date("Ym") . "/";
			if (!file_exists(__JPRASS_ROOT_DIR__ . "/" . $uploadDir)) {
				mkdir(__JPRASS_ROOT_DIR__ . "/" . $uploadDir);
			}

			//新文件名
			$newFileName = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $fileExt;
			//移动文件
			$saveFile = __JPRASS_ROOT_DIR__ . '/' . $uploadDir . $newFileName;
			if (move_uploaded_file($tmpName, $saveFile) === false) {
				return array('error' => 9, "message" => "上传文件失败。");
			}

			@chmod($saveFile, 0644);

			$data['uid'] = $this->loginUser['id'];
			$data['username'] = $this->loginUser['login_name'];
			$data['originalname'] = trim(htmlspecialchars($_FILES[$uploadName]['name']));
			$data['filepath'] = $uploadDir . $newFileName;
			$data['filesize'] = $fileSize;
			$data['filetype'] = $_FILES[$uploadName]['type'];
			$data['fileext'] = $fileExt;
			$data['dateline'] = time();
			$this->db("##_upload")->add($data);

			$dataId = $this->db("##_upload")->insertId();
			$isImage = in_array($fileExt, array('jpg', 'jpeg', 'gif', 'png', 'tiff', 'bmp')) ? 'true' : 'false';

			return array('error' => 0, 'url' => $uploadDir . $newFileName, 'id' => $dataId, "isImage" => $isImage);
		}
	}

}

?>