<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	CommentCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class CommentCtrl extends BaseCtrl {

	public function _post_index() {
		$txCaptcha = StringFilter::val($this->request->tx_captcha)->filter("text");
		$sessCaptcha = isset($_SESSION["captcha_session_key"]) ? $_SESSION["captcha_session_key"] : NULL;

		unset($_SESSION["captcha_session_key"]);
		if ($sessCaptcha !== $txCaptcha) {
			return array("state" => false, "message" => "验证码错误！");
		}

		$comment = array(
			'aid' => StringFilter::val($this->request->aid)->filter("int"),
			'username' => StringFilter::val($this->request->tx_username)->filter("xss"),
			'email' => StringFilter::val($this->request->tx_email)->filter("xss"),
			'homepage' => StringFilter::val($this->request->tx_homepage)->filter("xss"),
			'content' => StringFilter::val($this->request->tx_content)->filter("xss"),
		);

		$comment['ip'] = $this->request->getClientIP();
		$find = $this->db("##_restricted_ip")->find("id=" . ip2long($comment['ip']));
		if ($find) {
			return array("state" => false, "message" => "对不起，因为某些原因，你的评论无法提交！", "needRefresh" => true);
		}

		$aid = $this->db("##_article")->field("t.id")->find("id=" . $comment['aid']);
		if (!$aid) {
			return array("state" => false, "message" => "你所评论的文章不存在。");
		}
		if (empty($comment['username'])) {
			return array("state" => false, "message" => "请填写你的昵称。");
		}
		if (empty($comment['email'])) {
			return array("state" => false, "message" => '请输入你的邮箱地址。');
		}
		if (!preg_match('/^[0-9a-z]+[0-9a-z_\.\-]*@[0-9a-z\-]+(\.[a-z]{2,4}){1,2}$/i', $comment['email'])) {
			return array("state" => false, "message" => "你输入的邮箱地址不合法。");
		}
		if (empty($comment['content'])) {
			return array("state" => false, "message" => '请输入留言内容。');
		}
		if (strlen($comment['content']) > 255) {
			return array("state" => false, "message" => '评论内容不能超过255字节，当前的内容长度为' . strlen($comment['content']) . '字节。');
		}
		$arr = array();
		preg_match_all("#<a([^>]*)>(.*)<\/a>#iU", $comment['content'], $arr);
		if ($arr[0]) {
			$comment['ischeck'] = 0;
			$this->db("##_restricted_ip")->add(array(
				"id" => ip2long($comment['ip']),
				'ip' => $comment['ip'],
				'dateline' => time()
			));
		} else {
			$comment['ischeck'] = 1;
		}
		$comment['content'] = nl2br(htmlspecialchars($comment['content']));
		$comment['dateline'] = time();

		$res = $this->db("##_comment")->add($comment);

		if ($res) {
			return array("state" => true, "message" => "提交评论成功", "needRefresh" => true);
		} else {
			return array("state" => false, "message" => "系统忙，请稍后再试");
		}
	}

}

?>
