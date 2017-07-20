<?php
class onamae_domaincreate extends core_api {
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
			"actionType"=>"DomainCreate",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainCreate();
	}
	public function onamae_DomainCreate () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// The following parameters can set multiple values at once for bulk registration. 
		// At this time, please note that the parameter names are different.
		$this->setParseDomains();
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$this->setParseNameServer();
		// Domain information extension item (additional parameter for NAME domain)
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
	}
	public function setParseSingle () {
		// period
		if(isset($this->params["period"])&&$this->params["period"]!=='') {
			$this->query_string = $this->query_string."&period=".$this->params["period"];
		}
		// autoRenew
		if(isset($this->params["autoRenew"])&&$this->params["autoRenew"]!=='') {
			$this->query_string = $this->query_string."&autoRenew=".$this->params["autoRenew"];
		}
		// proxyflg
		if(isset($this->params["proxyflg"])&&$this->params["proxyflg"]!=='') {
			$this->query_string = $this->query_string."&proxyflg=".$this->params["proxyflg"];
		}
		// emailForwardTo
		if(isset($this->params["emailForwardTo"])&&$this->params["emailForwardTo"]!=='') {
			$this->query_string = $this->query_string."&emailForwardTo=".$this->params["emailForwardTo"];
		}
	}
	public function setParseBulk () {
		// periods
		if(isset($this->params["periods"])&&is_array($this->params["periods"])) {
			foreach ($this->params["periods"] as $periods_key => $periods_value) {
			 	$this->query_string = $this->query_string."&periods=".$periods_value;
			}
		}
		// autoRenews
		if(isset($this->params["autoRenews"])&&is_array($this->params["autoRenews"])) {
			foreach ($this->params["autoRenews"] as $autoRenews_key => $autoRenews_value) {
			 	$this->query_string = $this->query_string."&autoRenews=".$autoRenews_value;
			}
		}
		// proxyflgs
		if(isset($this->params["proxyflgs"])&&is_array($this->params["proxyflgs"])) {
			foreach ($this->params["proxyflgs"] as $proxyflgs_key => $proxyflgs_value) {
			 	$this->query_string = $this->query_string."&proxyflgs=".$proxyflgs_value;
			}
		}
		// emailForwardTos
		if(isset($this->params["emailForwardTos"])&&is_array($this->params["emailForwardTos"])) {
			foreach ($this->params["emailForwardTos"] as $emailForwardTos_key => $emailForwardTos_value) {
			 	$this->query_string = $this->query_string."&emailForwardTos=".$emailForwardTos_value;
			}
		}
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domainId':
				// domainId
				$this->query_string = $this->query_string."&domainId=".$this->params["domainId"];
				$this->setParseSingle();
			break;
			case 'domainName':
				// domainName
				$this->query_string = $this->query_string."&domainName=".$this->params["domainName"];
				$this->setParseSingle();
			break;
			case 'domainIds':
				// domainIds
				foreach ($this->params["domainIds"] as $domainIds_key => $domainIds_value) {
		 			$this->query_string = $this->query_string."&domainIds=".$domainIds_value;
		 		}
		 		$this->setParseBulk();
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

		if(isset($this->params["srLrKeyword"])&&$this->params["srLrKeyword"]!=='') {
			$this->data["srLrKeyword"] = $this->params["srLrKeyword"];
		}
		if(isset($this->params["tncId"])&&$this->params["tncId"]!=='') {
			$this->data["tncId"] = $this->params["tncId"];
		}
		if(isset($this->params["smd"])&&$this->params["smd"]!=='') {
			$this->data["smd"] = $this->params["smd"];
		}
		if(isset($this->params["RegistryPremium"])&&$this->params["RegistryPremium"]!=='') {
			$this->data["RegistryPremium"] = $this->params["RegistryPremium"];
		}
		if(isset($this->params["srLrKeywords"])&&$this->params["srLrKeywords"]!=='') {
			$this->data["srLrKeywords"] = $this->params["srLrKeywords"];
		}
		if(isset($this->params["tncIds"])&&$this->params["tncIds"]!=='') {
			$this->data["tncIds"] = $this->params["tncIds"];
		}
		if(isset($this->params["smds"])&&$this->params["smds"]!=='') {
			$this->data["smds"] = $this->params["smds"];
		}
		if(isset($this->params["RegistryPremiums"])&&$this->params["RegistryPremiums"]!=='') {
			$this->data["RegistryPremiums"] = $this->params["RegistryPremiums"];
		}
		// Default Payment Type
		$this->data["paymentType"] = domain_api::$paymentType;

		// Domain information extension item (additional parameter for TEL domain) 
		if(isset($this->params["whoisType"])&&$this->params["whoisType"]!=='') {
			$this->data["whoisType"] = $this->params["whoisType"];
		}
		if(isset($this->params["publish"])&&$this->params["publish"]!=='') {
			$this->data["publish"] = $this->params["publish"];
		}

		// CED information (additional parameter for ASIA domain)
		if(isset($this->params["primaryCed"])&&$this->params["primaryCed"]!=='') {
			$this->data["primaryCed"] = $this->params["primaryCed"];
		}
		if(isset($this->params["cedCcLocality"])&&$this->params["cedCcLocality"]!=='') {
			$this->data["cedCcLocality"] = $this->params["cedCcLocality"];
		}
		if(isset($this->params["cedState"])&&$this->params["cedState"]!=='') {
			$this->data["cedState"] = $this->params["cedState"];
		}
		if(isset($this->params["cedCity"])&&$this->params["cedCity"]!=='') {
			$this->data["cedCity"] = $this->params["cedCity"];
		}
		if(isset($this->params["cedLegalEntityType"])&&$this->params["cedLegalEntityType"]!=='') {
			$this->data["cedLegalEntityType"] = $this->params["cedLegalEntityType"];
		}
		if(isset($this->params["cedIdentificationNumber"])&&$this->params["cedIdentificationNumber"]!=='') {
			$this->data["cedIdentificationNumber"] = $this->params["cedIdentificationNumber"];
		}
		if(isset($this->params["cedRemark1"])&&$this->params["cedRemark1"]!=='') {
			$this->data["cedRemark1"] = $this->params["cedRemark1"];
		}
		if(isset($this->params["cedRemark2"])&&$this->params["cedRemark2"]!=='') {
			$this->data["cedRemark2"] = $this->params["cedRemark2"];
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

		// Organization Information
		if(isset($this->params["orgOrganization"])&&$this->params["orgOrganization"]!=='') {
			$this->data["orgOrganization"] = $this->params["orgOrganization"];
		}
		if(isset($this->params["orgOrganizationMl"])&&$this->params["orgOrganizationMl"]!=='') {
			$this->data["orgOrganizationMl"] = $this->params["orgOrganizationMl"];
		}
		if(isset($this->params["orgOrganizationMlKana"])&&$this->params["orgOrganizationMlKana"]!=='') {
			$this->data["orgOrganizationMlKana"] = $this->params["orgOrganizationMlKana"];
		}
		if(isset($this->params["orgOrganizationType"])&&$this->params["orgOrganizationType"]!=='') {
			$this->data["orgOrganizationType"] = $this->params["orgOrganizationType"];
		}
		if(isset($this->params["orgCc"])&&$this->params["orgCc"]!=='') {
			$this->data["orgCc"] = $this->params["orgCc"];
		}
		if(isset($this->params["orgPc"])&&$this->params["orgPc"]!=='') {
			$this->data["orgPc"] = $this->params["orgPc"];
		}
		if(isset($this->params["orgSp"])&&$this->params["orgSp"]!=='') {
			$this->data["orgSp"] = $this->params["orgSp"];
		}
		if(isset($this->params["orgCity"])&&$this->params["orgCity"]!=='') {
			$this->data["orgCity"] = $this->params["orgCity"];
		}
		if(isset($this->params["orgStreet1"])&&$this->params["orgStreet1"]!=='') {
			$this->data["orgStreet1"] = $this->params["orgStreet1"];
		}
		if(isset($this->params["orgStreet2"])&&$this->params["orgStreet2"]!=='') {
			$this->data["orgStreet2"] = $this->params["orgStreet2"];
		}
		if(isset($this->params["orgCityML"])&&$this->params["orgCityML"]!=='') {
			$this->data["orgCityML"] = $this->params["orgCityML"];
		}
		if(isset($this->params["orgStreet1Ml"])&&$this->params["orgStreet1Ml"]!=='') {
			$this->data["orgStreet1Ml"] = $this->params["orgStreet1Ml"];
		}
		if(isset($this->params["orgStreet2Ml"])&&$this->params["orgStreet2Ml"]!=='') {
			$this->data["orgStreet2Ml"] = $this->params["orgStreet2Ml"];
		}
		if(isset($this->params["orgRegistrationDate"])&&$this->params["orgRegistrationDate"]!=='') {
			$this->data["orgRegistrationDate"] = $this->params["orgRegistrationDate"];
		}
		if(isset($this->params["orgRegistrationAddress"])&&$this->params["orgRegistrationAddress"]!=='') {
			$this->data["orgRegistrationAddress"] = $this->params["orgRegistrationAddress"];
		}
		if(isset($this->params["orgRepresentName"])&&$this->params["orgRepresentName"]!=='') {
			$this->data["orgRepresentName"] = $this->params["orgRepresentName"];
		}
		if(isset($this->params["orgRepresentNameMl"])&&$this->params["orgRepresentNameMl"]!=='') {
			$this->data["orgRepresentNameMl"] = $this->params["orgRepresentNameMl"];
		}
		if(isset($this->params["orgTitleMl"])&&$this->params["orgTitleMl"]!=='') {
			$this->data["orgTitleMl"] = $this->params["orgTitleMl"];
		}
	}
}
?>