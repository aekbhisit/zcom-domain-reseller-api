<?php
class onamae_registrypremiumdomainprice extends core_api {
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
			"actionType"=>"RegistryPremiumDomainPrice",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_RegistryPremiumDomainPrice($params);
	}
	public function onamae_RegistryPremiumDomainPrice ($params) {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$this->setParseDomains();
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domainName':
				// domainName
				$this->query_string = $this->query_string."&domainName=".$this->params["domainName"];
			break;
		}
	}
	public function checkValidateParams () {
		if(isset($this->params["domainName"])&&$this->params["domainName"]!=='') {
			$this->flag_domain = "domainName";
		}
		if($this->flag_domain==='') {
			//exit;
		}
		if(isset($this->params["period"])&&$this->params["period"]!=='') {
			$this->data["period"] = $this->params["period"];
		}
		if(isset($this->params["command"])&&$this->params["command"]!=='') {
			$this->data["command"] = $this->params["command"];
		}
	}
}
?>