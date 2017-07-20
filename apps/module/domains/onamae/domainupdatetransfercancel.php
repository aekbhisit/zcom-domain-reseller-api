<?php
class onamae_domainupdatetransfercancel extends core_api {
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
			"actionType"=>"DomainUpdateTransferCancel",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainUpdateTransferCancel($params);
	}
	public function onamae_DomainUpdateTransferCancel ($params) {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// The following parameters can set multiple values at once for bulk registration. 
		// At this time, please note that the parameter names are different.
		$this->setParseDomains();
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domainId':
				// domainId
				$this->query_string = $this->query_string."&domainId=".$this->params["domainId"];
			break;
			case 'domainName':
				// domainName
				$this->query_string = $this->query_string."&domainName=".$this->params["domainName"];
			break;
		}
	}
	public function checkValidateParams () {
		if(isset($this->params["domainId"])&&$this->params["domainId"]!=='') {
			$this->flag_domain = "domainId";
		}
		if(isset($this->params["domainName"])&&$this->params["domainName"]!=='') {
			$this->flag_domain = "domainName";
		}
		if($this->flag_domain==='') {
			//exit;
		}
	}
}
?>