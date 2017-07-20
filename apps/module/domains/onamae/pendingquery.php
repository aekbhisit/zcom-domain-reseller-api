<?php
class onamae_pendingquery extends core_api {
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
			"actionType"=>"PendingQuery",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_PendingQuery($params);
	}
	public function onamae_PendingQuery ($params) {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function checkValidateParams () {
		if(isset($this->params["pendingId"])&&$this->params["pendingId"]!=='') {
			$this->data["pendingId"] = $this->params["pendingId"];
		}
	}
}
?>