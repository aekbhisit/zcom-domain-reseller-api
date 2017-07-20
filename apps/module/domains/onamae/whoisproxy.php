<?php
class onamae_whoisproxy extends core_api {
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
			"actionType"=>"WhoisProxy",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_WhoisProxy();
	}
	public function onamae_WhoisProxy () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// The following parameters can set multiple values at once for bulk registration. 
		// At this time, please note that the parameter names are different.
		$this->setParseDomains();
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		return $response;
	}
	public function setParseSingle () {
		// proxyflg
		if(isset($this->params["proxyflg"])&&$this->params["proxyflg"]!=='') {
			$this->query_string = $this->query_string."&proxyflg=".$this->params["proxyflg"];
		}
	}
	public function setParseBulk () {
		// proxyflgs
		if(isset($this->params["proxyflgs"])&&is_array($this->params["proxyflgs"])) {
			foreach ($this->params["proxyflgs"] as $proxyflgs_key => $proxyflgs_value) {
			 	$this->query_string = $this->query_string."&proxyflgs=".$proxyflgs_value;
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
	}
}
?>