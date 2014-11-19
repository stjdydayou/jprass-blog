<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	YixinCtrl.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
define("__YIXIN_TOKEN__", "yixin");
define("__CHECK_TOKEN__", true);
class YixinCtrl extends BaseCtrl {
	private $requestObject;
	
	
	private function send_text($contentStr){
		$fromUsername = $this->requestObject->FromUserName;
		$toUsername = $this->requestObject->ToUserName;
		$time = time();
		$textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
		
		$msgType = "text";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
	}
	
	private function checkSignature() {
		if(__CHECK_TOKEN__){
			$signature = isset($_GET["signature"]) ? $_GET["signature"] : "";
			$timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : "";
			$nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : "";
			$tmpArr = array(__YIXIN_TOKEN__, $timestamp, $nonce);
			sort($tmpArr);
			$tmpStr = sha1(implode($tmpArr));

			if ($tmpStr == $signature) {
				return true;
			}else{
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
					"msg_from"=>'yixin'
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
		$this->{"event_".strtolower($this->requestObject->Event)}();
	}
	
	//接收到测试的文字信息
	private function fun_text() {
		$content = (string) $this->requestObject->Content;
		if ("test" == $content) {
			$contentStr = "我已经收到你的消息了";
			$this->send_text($contentStr);
		}
	}
	//被订阅自动回复
	private function event_subscribe() {
		$contentStr = JPrassApi::C("yixin.yixin_subscribe");
		$this->send_text($contentStr);
	}
	
	//菜单事件处理
	private function event_click() {
		$this->{"event_click_".$this->requestObject->EventKey}();
	}
	
	private function event_click_blog(){
		$contentStr = "个人博客地址：http://www.joyphper.net，欢迎大家光临！";
		$this->send_text($contentStr);
	}
	
	private function event_click_about(){
		$contentStr = "高级软件开发工程师，现混迹于某电子商务公司，主要的技术领域php和java。
						\n联系QQ：
						\n97142822
						\nQQ群：
						\n106501129
						\nEmail：
						\nme@joyphper.net";
		$this->send_text($contentStr);
	}
	
	private function event_click_marry(){
		$contentStr = "沈友军先生和丁红慧小姐将于公历2014年1月20日(星期一)在湖南省衡阳县举行婚礼，届时恭候您的光临。";
		$this->send_text($contentStr);
	}
}

?>
