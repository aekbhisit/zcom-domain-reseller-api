<?php
class onamae_domainupdatetransfer extends core_api {
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
			"actionType"=>"DomainUpdateTransfer",
			"responseFormat"=>domain_api::$responseFormat,
			"languageCode"=>domain_api::$languageCode
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainUpdateTransfer($params);
	}
	public function onamae_DomainUpdateTransfer ($params) {
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
			case 'domainIds':
				// domainIds
				foreach ($this->params["domainIds"] as $domainIds_key => $domainIds_value) {
		 			$this->query_string = $this->query_string."&domainIds=".$domainIds_value;
		 		}
			break;
			case 'domainNames':
				// domainNames
				foreach ($this->params["domainNames"] as $domainNames_key => $domainNames_value) {
		 			$this->query_string = $this->query_string."&domainNames=".$domainNames_value;
		 		}
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
		if(isset($this->params["domainIds"])&&is_array($this->params["domainIds"])) {
			$this->flag_domain = "domainIds";
			if(count($this->params["domainIds"])>100) {
				//exit;
			}
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
		// approvalEmail
		if(isset($this->params["approvalEmail"])&&$this->params["approvalEmail"]!=='') {
			$this->data["approvalEmail"] = $this->params["approvalEmail"];
		}

		// Registrant information
		if(isset($this->params["regFname"])&&$this->params["regFname"]!=='') {
			$this->data["regFname"] = $this->params["regFname"];
		}
		if(isset($this->params["regLname"])&&$this->params["regLname"]!=='') {
			$this->data["regLname"] = $this->params["regLname"];
		}
		if(isset($this->params["regRole"])&&$this->params["regRole"]!=='') {
			$this->data["regRole"] = $this->params["regRole"];
		}
		if(isset($this->params["regOrganization"])&&$this->params["regOrganization"]!=='') {
			$this->data["regOrganization"] = $this->params["regOrganization"];
		}
		if(isset($this->params["regCc"])&&$this->params["regCc"]!=='') {
			$this->data["regCc"] = $this->params["regCc"];
		}
		if(isset($this->params["regPc"])&&$this->params["regPc"]!=='') {
			$this->data["regPc"] = $this->params["regPc"];
		}
		if(isset($this->params["regSp"])&&$this->params["regSp"]!=='') {
			$this->data["regSp"] = $this->params["regSp"];
		}
		if(isset($this->params["regCity"])&&$this->params["regCity"]!=='') {
			$this->data["regCity"] = $this->params["regCity"];
		}
		if(isset($this->params["regStreet1"])&&$this->params["regStreet1"]!=='') {
			$this->data["regStreet1"] = $this->params["regStreet1"];
		}
		if(isset($this->params["regStreet2"])&&$this->params["regStreet2"]!=='') {
			$this->data["regStreet2"] = $this->params["regStreet2"];
		}
		if(isset($this->params["regPhone"])&&$this->params["regPhone"]!=='') {
			$this->data["regPhone"] = $this->params["regPhone"];
		}
		if(isset($this->params["regFax"])&&$this->params["regFax"]!=='') {
			$this->data["regFax"] = $this->params["regFax"];
		}
		if(isset($this->params["regEmail"])&&$this->params["regEmail"]!=='') {
			$this->data["regEmail"] = $this->params["regEmail"];
		}

		// Extended Parameter in Japanese (usable ASCII characters) 
		if(isset($this->params["regFnameMl"])&&$this->params["regFnameMl"]!=='') {
			$this->data["regFnameMl"] = $this->params["regFnameMl"];
		}
		if(isset($this->params["regLnameMl"])&&$this->params["regLnameMl"]!=='') {
			$this->data["regLnameMl"] = $this->params["regLnameMl"];
		}
		if(isset($this->params["regOrganizationMl"])&&$this->params["regOrganizationMl"]!=='') {
			$this->data["regOrganizationMl"] = $this->params["regOrganizationMl"];
		}
		if(isset($this->params["regCityMl"])&&$this->params["regCityMl"]!=='') {
			$this->data["regCityMl"] = $this->params["regCityMl"];
		}
		if(isset($this->params["regStreet1Ml"])&&$this->params["regStreet1Ml"]!=='') {
			$this->data["regStreet1Ml"] = $this->params["regStreet1Ml"];
		}
		if(isset($this->params["regStreet2Ml"])&&$this->params["regStreet2Ml"]!=='') {
			$this->data["regStreet2Ml"] = $this->params["regStreet2Ml"];
		}
	}
}
?>