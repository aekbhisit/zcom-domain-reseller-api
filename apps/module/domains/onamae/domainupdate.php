<?php
class onamae_domainupdate extends core_api {
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
			"actionType"=>"DomainUpdate",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainUpdate();
	}
	public function onamae_DomainUpdate () {
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// The following parameters can set multiple values at once for bulk registration. 
		// At this time, please note that the parameter names are different.
		$this->setParseDomains();
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$this->setParseNameServer();
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function setParseNameServer () {
		// ns
		if(isset($this->params["ns"])&&is_array($this->params["ns"])) {
			foreach ($this->params["ns"] as $ns_key => $ns_value) {
			 	$this->query_string = $this->query_string."&ns=".$ns_value;
			}
		}
		// nsExclusion
		if(isset($this->params["nsExclusion"])&&is_array($this->params["nsExclusion"])) {
			foreach ($this->params["nsExclusion"] as $nsExclusion_key => $nsExclusion_value) {
			 	$this->query_string = $this->query_string."&nsExclusion=".$nsExclusion_value;
			}
		}
		// AutoRenew
		if(isset($this->params["autoRenew"])&&is_array($this->params["autoRenew"])) {
			foreach ($this->params["autoRenew"] as $autoRenew_key => $autoRenew_key) {
			 	$this->query_string = $this->query_string."&autoRenew=".$autoRenew_key;
			}
			if(isset($this->params["autoRenew"])&&$this->params["autoRenew"]!=='') {
				$this->data["autoRenew"] = $this->query_string."&autoRenew=".$nsExclusion_value;
			}
		}
		// transferLock
		if(isset($this->params["transferLock"])&&is_array($this->params["transferLock"])) {
			foreach ($this->params["transferLock"] as $transferLock_key => $transferLock_key) {
			 	$this->query_string = $this->query_string."&transferLock=".$transferLock_key;
			}
		}
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domainId':
				$this->query_string = $this->query_string."&domainId=".$this->params["domainId"];
			break;
			case 'domainName':
				$this->query_string = $this->query_string."&domainName=".$this->params["domainName"];
			break;
			case 'domainIds':
				foreach ($this->params["domainIds"] as $domainIds_key => $domainIds_value) {
		 			$this->query_string = $this->query_string."&domainIds=".$domainIds_value;
		 		}
			break;
			case 'domainNames':
				foreach ($this->params["domainNames"] as $domainNames_key => $domainNames_value) {
		 			$this->query_string = $this->query_string."&domainNames=".$domainNames_value;
		 		}
			break;
		}
	}
	public function checkValidateParams () {
		if(!isset($this->params["domainId"])&&!isset($this->params["domainName"])&&!isset($this->params["domainIds"])&&!isset($this->params["domainNames"])) {
			//exit;
		}
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
		// Registrant information
		if(isset($this->params["regFname"])&&$this->params["regFname"]!=='') {
			$this->data["regFname"] = $this->params["regFname"];
		}
		if(isset($this->params["regLname"])&&$this->params["regLname"]!=='') {
			$this->data["regLname"] = $this->params["regLname"];
		}
		if(isset($this->params["regLname"])&&$this->params["regLname"]!=='') {
			$this->data["regLname"] = $this->params["regLname"];
		}
		if(isset($this->params["regLname"])&&$this->params["regLname"]!=='') {
			$this->data["regLname"] = $this->params["regLname"];
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

		// US extension information
		if(isset($this->params["RegNexusCategory"])&&$this->params["RegNexusCategory"]!=='') {
			$this->data["RegNexusCategory"] = $this->params["RegNexusCategory"];
		}
		if(isset($this->params["RegNationality"])&&$this->params["RegNationality"]!=='') {
			$this->data["RegNationality"] = $this->params["RegNationality"];
		}
		if(isset($this->params["RegAppPurpose"])&&$this->params["RegAppPurpose"]!=='') {
			$this->data["RegAppPurpose"] = $this->params["RegAppPurpose"];
		}

		// US extension information
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
		if(isset($this->params["regDivisionMl"])&&$this->params["regDivisionMl"]!=='') {
			$this->data["regDivisionMl"] = $this->params["regDivisionMl"];
		}

		// Admin Contact Information
		if(isset($this->params["admFname"])&&$this->params["admFname"]!=='') {
			$this->data["admFname"] = $this->params["admFname"];
		}
		if(isset($this->params["admLname"])&&$this->params["admLname"]!=='') {
			$this->data["admLname"] = $this->params["admLname"];
		}
		if(isset($this->params["admRole"])&&$this->params["admRole"]!=='') {
			$this->data["admRole"] = $this->params["admRole"];
		}
		if(isset($this->params["admOrganization"])&&$this->params["admOrganization"]!=='') {
			$this->data["admOrganization"] = $this->params["admOrganization"];
		}
		if(isset($this->params["admCc"])&&$this->params["admCc"]!=='') {
			$this->data["admCc"] = $this->params["admCc"];
		}
		if(isset($this->params["admPc"])&&$this->params["admPc"]!=='') {
			$this->data["admPc"] = $this->params["admPc"];
		}
		if(isset($this->params["admSp"])&&$this->params["admSp"]!=='') {
			$this->data["admSp"] = $this->params["admSp"];
		}
		if(isset($this->params["admCity"])&&$this->params["admCity"]!=='') {
			$this->data["admCity"] = $this->params["admCity"];
		}
		if(isset($this->params["admStreet1"])&&$this->params["admStreet1"]!=='') {
			$this->data["admStreet1"] = $this->params["admStreet1"];
		}
		if(isset($this->params["admStreet2"])&&$this->params["admStreet2"]!=='') {
			$this->data["admStreet2"] = $this->params["admStreet2"];
		}
		if(isset($this->params["admPhone"])&&$this->params["admPhone"]!=='') {
			$this->data["admPhone"] = $this->params["admPhone"];
		}
		if(isset($this->params["admFax"])&&$this->params["admFax"]!=='') {
			$this->data["admFax"] = $this->params["admFax"];
		}
		if(isset($this->params["admEmail"])&&$this->params["admEmail"]!=='') {
			$this->data["admEmail"] = $this->params["admEmail"];
		}

		// Tech Contact Information
		if(isset($this->params["tecFname"])&&$this->params["tecFname"]!=='') {
			$this->data["tecFname"] = $this->params["tecFname"];
		}
		if(isset($this->params["tecLname"])&&$this->params["tecLname"]!=='') {
			$this->data["tecLname"] = $this->params["tecLname"];
		}
		if(isset($this->params["tecRole"])&&$this->params["tecRole"]!=='') {
			$this->data["tecRole"] = $this->params["tecRole"];
		}
		if(isset($this->params["tecOrganization"])&&$this->params["tecOrganization"]!=='') {
			$this->data["tecOrganization"] = $this->params["tecOrganization"];
		}
		if(isset($this->params["tecCc"])&&$this->params["tecCc"]!=='') {
			$this->data["tecCc"] = $this->params["tecCc"];
		}
		if(isset($this->params["tecPc"])&&$this->params["tecPc"]!=='') {
			$this->data["tecPc"] = $this->params["tecPc"];
		}
		if(isset($this->params["tecSp"])&&$this->params["tecSp"]!=='') {
			$this->data["tecSp"] = $this->params["tecSp"];
		}
		if(isset($this->params["tecCity"])&&$this->params["tecCity"]!=='') {
			$this->data["tecCity"] = $this->params["tecCity"];
		}
		if(isset($this->params["tecStreet1"])&&$this->params["tecStreet1"]!=='') {
			$this->data["tecStreet1"] = $this->params["tecStreet1"];
		}
		if(isset($this->params["tecStreet2"])&&$this->params["tecStreet2"]!=='') {
			$this->data["tecStreet2"] = $this->params["tecStreet2"];
		}
		if(isset($this->params["tecPhone"])&&$this->params["tecPhone"]!=='') {
			$this->data["tecPhone"] = $this->params["tecPhone"];
		}
		if(isset($this->params["tecFax"])&&$this->params["tecFax"]!=='') {
			$this->data["tecFax"] = $this->params["tecFax"];
		}
		if(isset($this->params["tecEmail"])&&$this->params["tecEmail"]!=='') {
			$this->data["tecEmail"] = $this->params["tecEmail"];
		}

		// Extended Parameter in Japanese (usable ASCII characters)
		if(isset($this->params["tecFnameMl"])&&$this->params["tecFnameMl"]!=='') {
			$this->data["tecFnameMl"] = $this->params["tecFnameMl"];
		}
		if(isset($this->params["tecLnameMl"])&&$this->params["tecLnameMl"]!=='') {
			$this->data["tecLnameMl"] = $this->params["tecLnameMl"];
		}
		if(isset($this->params["tecOrganizationMl"])&&$this->params["tecOrganizationMl"]!=='') {
			$this->data["tecOrganizationMl"] = $this->params["tecOrganizationMl"];
		}
		if(isset($this->params["tecCityMl"])&&$this->params["tecCityMl"]!=='') {
			$this->data["tecCityMl"] = $this->params["tecCityMl"];
		}
		if(isset($this->params["tecStreet1Ml"])&&$this->params["tecStreet1Ml"]!=='') {
			$this->data["tecStreet1Ml"] = $this->params["tecStreet1Ml"];
		}
		if(isset($this->params["tecStreet2Ml"])&&$this->params["tecStreet2Ml"]!=='') {
			$this->data["tecStreet2Ml"] = $this->params["tecStreet2Ml"];
		}
		if(isset($this->params["tecDivision"])&&$this->params["tecDivision"]!=='') {
			$this->data["tecDivision"] = $this->params["tecDivision"];
		}
		if(isset($this->params["tecDivisionMl"])&&$this->params["tecDivisionMl"]!=='') {
			$this->data["tecDivisionMl"] = $this->params["tecDivisionMl"];
		}
		if(isset($this->params["tecTitle "])&&$this->params["tecTitle "]!=='') {
			$this->data["tecTitle "] = $this->params["tecTitle "];
		}
		if(isset($this->params["tecTitleMl"])&&$this->params["tecTitleMl"]!=='') {
			$this->data["tecTitleMl"] = $this->params["tecTitleMl"];
		}

		// Billing Contact Information
		if(isset($this->params["bilFname"])&&$this->params["bilFname"]!=='') {
			$this->data["bilFname"] = $this->params["bilFname"];
		}
		if(isset($this->params["bilLname"])&&$this->params["bilLname"]!=='') {
			$this->data["bilLname"] = $this->params["bilLname"];
		}
		if(isset($this->params["bilRole"])&&$this->params["bilRole"]!=='') {
			$this->data["bilRole"] = $this->params["bilRole"];
		}
		if(isset($this->params["bilOrganization"])&&$this->params["bilOrganization"]!=='') {
			$this->data["bilOrganization"] = $this->params["bilOrganization"];
		}
		if(isset($this->params["bilCc"])&&$this->params["bilCc"]!=='') {
			$this->data["bilCc"] = $this->params["bilCc"];
		}
		if(isset($this->params["bilPc"])&&$this->params["bilPc"]!=='') {
			$this->data["bilPc"] = $this->params["bilPc"];
		}
		if(isset($this->params["bilSp"])&&$this->params["bilSp"]!=='') {
			$this->data["bilSp"] = $this->params["bilSp"];
		}
		if(isset($this->params["bilCity"])&&$this->params["bilCity"]!=='') {
			$this->data["bilCity"] = $this->params["bilCity"];
		}
		if(isset($this->params["bilStreet1"])&&$this->params["bilStreet1"]!=='') {
			$this->data["bilStreet1"] = $this->params["bilStreet1"];
		}
		if(isset($this->params["bilStreet2"])&&$this->params["bilStreet2"]!=='') {
			$this->data["bilStreet2"] = $this->params["bilStreet2"];
		}
		if(isset($this->params["bilPhone"])&&$this->params["bilPhone"]!=='') {
			$this->data["bilPhone"] = $this->params["bilPhone"];
		}
		if(isset($this->params["bilFax"])&&$this->params["bilFax"]!=='') {
			$this->data["bilFax"] = $this->params["bilFax"];
		}
		if(isset($this->params["bilEmail"])&&$this->params["bilEmail"]!=='') {
			$this->data["bilEmail"] = $this->params["bilEmail"];
		}

		// Public Contact Information (for .JP domain)
		if(isset($this->params["agoFname"])&&$this->params["agoFname"]!=='') {
			$this->data["agoFname"] = $this->params["agoFname"];
		}
		if(isset($this->params["agoLname"])&&$this->params["agoLname"]!=='') {
			$this->data["agoLname"] = $this->params["agoLname"];
		}
		if(isset($this->params["agoRole"])&&$this->params["agoRole"]!=='') {
			$this->data["agoRole"] = $this->params["agoRole"];
		}
		if(isset($this->params["agoOrganization"])&&$this->params["agoOrganization"]!=='') {
			$this->data["agoOrganization"] = $this->params["agoOrganization"];
		}
		if(isset($this->params["agoCc"])&&$this->params["agoCc"]!=='') {
			$this->data["agoCc"] = $this->params["agoCc"];
		}
		if(isset($this->params["agoPc"])&&$this->params["agoPc"]!=='') {
			$this->data["agoPc"] = $this->params["agoPc"];
		}
		if(isset($this->params["agoSp"])&&$this->params["agoSp"]!=='') {
			$this->data["agoSp"] = $this->params["agoSp"];
		}
		if(isset($this->params["agoCity"])&&$this->params["agoCity"]!=='') {
			$this->data["agoCity"] = $this->params["agoCity"];
		}
		if(isset($this->params["agoStreet1"])&&$this->params["agoStreet1"]!=='') {
			$this->data["agoStreet1"] = $this->params["agoStreet1"];
		}
		if(isset($this->params["agoStreet2"])&&$this->params["agoStreet2"]!=='') {
			$this->data["agoStreet2"] = $this->params["agoStreet2"];
		}
		if(isset($this->params["agoPhone"])&&$this->params["agoPhone"]!=='') {
			$this->data["agoPhone"] = $this->params["agoPhone"];
		}
		if(isset($this->params["agoFax"])&&$this->params["agoFax"]!=='') {
			$this->data["agoFax"] = $this->params["agoFax"];
		}
		if(isset($this->params["agoEmail"])&&$this->params["agoEmail"]!=='') {
			$this->data["agoEmail"] = $this->params["agoEmail"];
		}
		if(isset($this->params["agoFnameMl"])&&$this->params["agoFnameMl"]!=='') {
			$this->data["agoFnameMl"] = $this->params["agoFnameMl"];
		}
		if(isset($this->params["agoLnameMl"])&&$this->params["agoLnameMl"]!=='') {
			$this->data["agoLnameMl"] = $this->params["agoLnameMl"];
		}
		if(isset($this->params["agoOrganizationMl"])&&$this->params["agoOrganizationMl"]!=='') {
			$this->data["agoOrganizationMl"] = $this->params["agoOrganizationMl"];
		}
		if(isset($this->params["agoCityMl"])&&$this->params["agoCityMl"]!=='') {
			$this->data["agoCityMl"] = $this->params["agoCityMl"];
		}
		if(isset($this->params["agoStreet1Ml"])&&$this->params["agoStreet1Ml"]!=='') {
			$this->data["agoStreet1Ml"] = $this->params["agoStreet1Ml"];
		}
		if(isset($this->params["agoStreet2Ml"])&&$this->params["agoStreet2Ml"]!=='') {
			$this->data["agoStreet2Ml"] = $this->params["agoStreet2Ml"];
		}
	}
}
?>