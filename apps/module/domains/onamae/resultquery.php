<?php
class onamae_resultquery extends core_api {
	var $array;
	var $query_string;
	var $params;
	var $data;
	var $flag_domain;
	var $flag_domain_query;
	public function __construct() {
	}
	public function get ($params) {
		$this->params = $params;
		$this->data = array(
			"loginId"=>domain_api::$username_api,
			"loginPassword"=>domain_api::$password_api,
			"actionType"=>"ResultQuery",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_ResultQuery();
	}
	public function onamae_ResultQuery () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function checkValidateParams () {
		// receiptNo
		if(isset($this->params["receiptNo"])&&$this->params["receiptNo"]!=='') {
			$this->data["receiptNo"] = $this->params["receiptNo"];
		}
	}
}
?>