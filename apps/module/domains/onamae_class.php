<?php
class core_api {
	static $url_api;
	static $http_header;
	public function __construct(){
		self::$url_api = domain_api::$url_onamae_api;
		self::$http_header = domain_api::$host_http_header;
	}
	public static function get_api() {
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,self::$url_api);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_FAILONERROR,TRUE);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			throw new Exception(curl_error($ch));
		}
        curl_close($ch);
        return json_decode($response,true);
	}
	public static function post_api($query_string) {
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,self::$url_api);
		curl_setopt($ch,CURLOPT_HTTPHEADER,self::$http_header);
		curl_setopt($ch,CURLOPT_PORT, 443);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_FAILONERROR,TRUE);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$query_string);
		$response = curl_exec($ch);
		if (curl_errno($ch)) {
			throw new Exception(curl_error($ch));
		}
        curl_close($ch);
        return json_decode($response,true);
	}
	public function onamae_checkTask ($task,$params) {
		$o = new $task();
		return $o->get($params);
	}
	protected static function checkStatusResponse ($data) {
		if(isset($data['responseBean'])&&$data['responseBean']['result']['resultCode']==='10000') {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	protected static function getBodyData($data) {
		return $data['responseBean']['body'];
	}
	protected static function setUpFinal($data) {
		if(isset($data['responseBean']['parameters'])) { unset($data['responseBean']['parameters']); }
		return $data;
	}
	protected static function fnc_http_build_query ($data) {
		return http_build_query($data);
	}
}
?>