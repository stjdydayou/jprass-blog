<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	WeixinCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
define("__WEIXIN_TOKEN__", "weixin");
define("__CHECK_TOKEN__", false);
class WeixinCtrl extends BaseCtrl {
	
	private $requestObject;
	
	public function checkSignature() {
		if(__CHECK_TOKEN__){
			$signature = isset($_GET["signature"]) ? $_GET["signature"] : "";
			$timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : "";
			$nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : "";
			$tmpArr = array(__WEIXIN_TOKEN__, $timestamp, $nonce);
			sort($tmpArr);
			$tmpStr = sha1(implode($tmpArr));

			if ($tmpStr == $signature) {
				return true;
			} else {
				return false;
			}
		}else{
			return true;
		}
	}
	
	//消息处理入口
	public function index() {
		if ($this->checkSignature()) {
			if (isset($GLOBALS["HTTP_RAW_POST_DATA"]) && !empty($GLOBALS["HTTP_RAW_POST_DATA"])) {
				
				$this->requestObject = simplexml_load_string($GLOBALS["HTTP_RAW_POST_DATA"], 'SimpleXMLElement', LIBXML_NOCDATA);
				$data = array(
					"to_user_name" => $this->requestObject->ToUserName,
					"from_user_name" => $this->requestObject->FromUserName,
					"create_time" => $this->requestObject->CreateTime,
					"msg_type" => $this->requestObject->MsgType,
					"http_raw_post_data" => $GLOBALS["HTTP_RAW_POST_DATA"],
					"msg_id"=>$this->requestObject->MsgId,
					"msg_from"=>'weixin'
				);
				$this->db("##_public_platform_message")->add($data);
				if (method_exists($this, "fun_".$this->requestObject->MsgType)) {
					$this->{"fun_".$this->requestObject->MsgType}();
				}
			}
		}
	}
	
	//接收事件处理信息
	private function fun_event() {
		$this->{"event_".$this->requestObject->Event}();
	}
	
	//接收到测试的文字信息
	private function fun_text() {
		$content = (string) $this->requestObject->Content;
		if ("test" == $content) {
			$fromUsername = $this->requestObject->FromUserName;
			$toUsername = $this->requestObject->ToUserName;
			$time = time();
			$textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
			$msgType = "text";
			$contentStr = JPrassApi::C("weixin.weixin_subscribe");
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}
	}
	
	
	private function event_subscribe() {
		$fromUsername = $this->requestObject->FromUserName;
		$toUsername = $this->requestObject->ToUserName;
		$time = time();
		$textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
		$msgType = "text";
		$contentStr = JPrassApi::C("weixin.weixin_subscribe");
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	}

}

?>
