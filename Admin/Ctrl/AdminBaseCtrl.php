<?php

class AdminBaseCtrl extends BaseCtrl {

	protected $loginUser;

	public function __before() {
		if (!isset($_SESSION['login_user_session_key'])){
			JPrassApi::redirect("index.php?c=login");
			exit();
		}
		
		$this->loginUser = $_SESSION['login_user_session_key'];
		$this->assign("loginUser", $this->loginUser);
	}

	/**
	 * 设置页面消息提示内容
	 */
	public static function notice($notice, $type = 'success') {
		Cookie::set('__jprass_message', $notice, time() + 86400);
		Cookie::set('__jprass_message_type', $type, time() + 86400);
	}

	public function __after() {
		$__jprass_message = Cookie::get('__jprass_message');
		if (NULL !== $__jprass_message) {
			echo '<script type="text/javascript" src="' . JPrassApi::c('blog.url') . '/Script/jquery.sdialog.js"></script>';
			$__jprass_message_type = Cookie::get('__jprass_message_type');
			if (empty($__jprass_message_type))
				$__jprass_message_type = "success";

			echo '<script type="text/javascript">$.sdialog({content: "' . $__jprass_message . '"}).ok(true).icon("' . $__jprass_message_type . '");</script>';
			Cookie::delete('__jprass_message');
			Cookie::delete('__jprass_message_type');
		}
	}

	protected function buildPager($data) {

		$string = "<div class='div-pager'>";

		if ($data['current'] <= 1) {
			$string.="<span>首页</span>";
			$string.="<span>上一页</span>";
		} else {
			$string.="<a href='" . $this->buildPager_url($data['first']) . "'>首页</a>";
			$string.="<a href='" . $this->buildPager_url($data['prev']) . "'>上一页</a> ";
		}
		if (count($data['numbers'])) {
			foreach ($data['numbers'] as $_v) {
				if ($data['current'] == $_v) {
					$string.="<span class='current_page'>$_v</span>";
				} else {
					$string.="<a class='pnum' href='" . $this->buildPager_url($_v) . "'>$_v</a>";
				}
			}
		}
		if ($data['current'] >= $data['total']) {
			$string.="<span>下一页</span>";
			$string.="<span>末页</span>";
		} else {
			$string.="<a href='" . $this->buildPager_url($data['next']) . "'>下一页</a>";
			$string.="<a href='" . $this->buildPager_url($data['last']) . "'>末页</a> ";
		}
		$string.="<cite>共{$data['total']}页{$data['count']}条记录</cite>";
		$string.="</div>";
		return $string;
	}

	private function buildPager_url($page) {
		//组织参数
		$url = $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') ? '' : "?");
		$parse = parse_url($url);
		$params = "";
		if (isset($parse['query'])) {
			parse_str($parse['query'], $params);
			unset($params['p']);
			$url = $parse['path'] . '?' . http_build_query($params);
		}
		$url = $url . '&p={_page_}';

		return str_replace("{_page_}", $page, $url);
	}

}

?>