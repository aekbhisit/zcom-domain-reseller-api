<?php
class onamae_tldlist extends core_api {
	var $array;
	var $query_string;
	var $params;
	var $data;
	var $flag_domain;
	var $flag_domain_query;
	public function __construct(){
	}
	public function get ($params) {
		$this->params = $params;
		$this->data = array(
			"loginId"=>domain_api::$username_api,
			"loginPassword"=>domain_api::$password_api,
			"actionType"=>"TldList",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_TldList();
	}
	public function onamae_TldList () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function checkValidateParams () {
		if(isset($this->params["pageNo"])&&$this->params["pageNo"]!=='') {
			$this->data["pageNo"] = $this->params["pageNo"];
		}
		if(isset($this->params["lineCnt"])&&$this->params["lineCnt"]!=='') {
			$this->data["lineCnt"] = $this->params["lineCnt"];
		}
		if(isset($this->params["sortKey"])&&$this->params["sortKey"]!=='') {
			$this->data["sortKey"] = $this->params["sortKey"];
		}
		if(isset($this->params["soryType"])&&$this->params["soryType"]!=='') {
			$this->data["soryType"] = $this->params["soryType"];
		}
		if(isset($this->params["whoisAccuracyFlg"])&&$this->params["whoisAccuracyFlg"]!=='') {
			$this->data["whoisAccuracyFlg"] = $this->params["whoisAccuracyFlg"];
		}
	}
}
?>