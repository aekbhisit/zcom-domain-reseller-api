<?php
class onamae_domainrenew extends core_api {
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
			"actionType"=>"DomainRenew",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainRenew();
	}
	public function onamae_DomainRenew () {
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
	public function setParseSingle () {
		// curExpDate
		if(isset($this->params["curExpDate"])&&$this->params["curExpDate"]!=='') {
			$this->query_string = $this->query_string."&curExpDate=".$this->params["curExpDate"];
		}
		// period
		if(isset($this->params["period"])&&$this->params["period"]!=='') {
			$this->query_string = $this->query_string."&period=".$this->params["period"];
		}
		// autoRenew
		if(isset($this->params["autoRenew"])&&$this->params["autoRenew"]!=='') {
			$this->query_string = $this->query_string."&autoRenew=".$this->params["autoRenew"];
		}
	}
	public function setParseBulk () {
		// curExpDates
		if(isset($this->params["curExpDates"])&&is_array($this->params["curExpDates"])) {
			foreach ($this->params["curExpDates"] as $curExpDates_key => $curExpDates_value) {
			 	$this->query_string = $this->query_string."&curExpDates=".$curExpDates_value;
			}
		}
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

		// Default Payment Type
		$this->data["paymentType"] = domain_api::$paymentType;

		// if(isset($this->params["responseFormat"])&&$this->params["responseFormat"]!=='') {
		// 	$this->data["responseFormat"] = $this->params["responseFormat"];
		// }
	}
}
?>