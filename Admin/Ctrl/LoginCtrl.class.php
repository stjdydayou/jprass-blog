<?PHP

class LoginCtrl extends BaseCtrl {

	public function _get_index() {
		if (isset($_SESSION['login_user_session_key'])){
			JPrassApi::redirect("index.php");
		}
		return "login";
	}

	public function _post_index() {

		$loginName = StringFilter::val($this->request->loginName)->filter("xss");
		$loginPwd = $this->request->loginPwd;
		$captcha = StringFilter::val($this->request->captcha)->filter('text');
		$captchaSession = isset($_SESSION["captcha_session_key"]) ? $_SESSION["captcha_session_key"] : NULL;

		unset($_SESSION["captcha_session_key"]);

		if ($captchaSession !== $captcha) {
			return array("state" => false, "message" => "验证码错误！", "needRefresh" => true);
		}

		$user = $this->db("##_user")->where("`login_name`='{$loginName}'")->find();


		if (!$user || $user["login_pwd"] != md5($loginName . $loginPwd)) {
			return array("state" => false, "message" => "用户名或密码错误！", "needRefresh" => true);
		}

		$this->db("##_user")->where("`id`='" . $user['id'] . "'")->update(array("last_login_time" => time(), "last_login_ip" => $this->request->getClientIP()));

		$_SESSION['login_user_session_key'] = $user;

		return array("state" => true, "message" => "登录成功！", "location" => "index.php");
	}

}
