<?php
class onamae_ordersbatchresultquery extends core_api {
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
			"actionType"=>"OrdersBatchResultQuery",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_OrdersBatchResultQuery();
	}
	public function onamae_OrdersBatchResultQuery () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domainName':
				// domainName
				$this->query_string = $this->query_string."&domainName=".$this->params["domainName"];
				$this->setParseSingle();
			break;
			case 'domainNames':
				// domainNames
				foreach ($this->params["domainNames"] as $domainNames_key => $domainNames_value) {
		 			$this->query_string = $this->query_string."&domainNames=".$domainNames_value;
		 		}
		 		$this->setParseBulk();
			break;
		}
	}
	public function checkValidateParams () {
		if(isset($this->params["domainName"])&&$this->params["domainName"]!=='') {
			$this->flag_domain = "domainName";
		}	
		if(isset($this->params["domainNames"])&&is_array($this->params["domainNames"])) {
			$this->flag_domain = "domainNames";
			if(count($this->params["domainNames"])>100) {
				//exit;
			}
		}
		if($this->flag_domain==='') {
			//exit;
		}

	}
}
?>