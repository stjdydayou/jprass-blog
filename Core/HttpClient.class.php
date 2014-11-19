<?php

class HttpClient {

	function get($url, $params = array()) {
		if (empty($url) || !is_array($params)) {
			return false;
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$paramStr = '';
		if (count($params)) {
			foreach ($params as $k => $v) {
				$paramStr.=(empty($paramStr) ? '' : '&') . $k . '=' . $v;
			}
		}
		$url.=empty($paramStr) ? '' : '?' . $paramStr;
		curl_setopt($curl, CURLOPT_URL, $url);

		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		if ($info['http_code'] == 200)
			return $result;
		else
			return false;
	}

	function post($url,$params) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		if ($info['http_code'] == 200)
			return $result;
		else
			return false;
	}

}

?>