<?php
class onamae_domaincheck extends core_api {
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
			"actionType"=>"DomainCheck",
			"responseFormat"=>domain_api::$responseFormat
		);
		$this->flag_domain = '';
		$this->checkValidateParams();
		return $this->onamae_DomainCheck();
	}
	public function onamae_DomainCheck () {
		// query_string parse build url query paramiter
		$this->query_string = core_api::fnc_http_build_query($this->data);
		// The following parameters can set multiple values at once for bulk registration. 
		// At this time, please note that the parameter names are different.
		$this->setParseDomains();
		// For the followingTLDs, the number of name servers that can be allocated is limited.
		// .cn allowed within 5 /.tw allowed within 7 /.uk .be. gs allowed within 4
		$response = core_api::post_api($this->query_string);
		$response = core_api::setUpFinal($response);
		if(core_api::checkStatusResponse($response)) {
			$body = core_api::getBodyData($response);
			if(!empty($body['list'])) {
				foreach ($body['list'] as $key => $value) {
					$body['list'][$key]['text'] = $this->onamae_DomainCheck_Status($value['value']);
				}
			}
			$response['responseBean']['body'] = $body;
		}
		return $response;
	}
	public function setParseTld () {
		// tld
		if(isset($this->params["tld"])&&is_array($this->params["tld"])) {
			foreach ($this->params["tld"] as $tld_key => $tld_value) {
			 	$this->query_string = $this->query_string."&tld=".$tld_value;
			}
		}
	}
	public function setParseDomains () {
		switch ($this->flag_domain) {
			case 'domain':
				// domainName
				$this->query_string = $this->query_string."&domain=".$this->params["domain"];
				$this->setParseTld();
			break;
		}
	}
	public function checkValidateParams () {
		if(isset($this->params["domain"])&&$this->params["domain"]!=='') {
			$this->flag_domain = "domain";
		}
		if($this->flag_domain==='') {
			//exit;
		}
	}
	private function onamae_DomainCheck_Status ($status) {
		switch ($status) {
			case '0':
				return 'Registered';
			break;
			case '1':
				return 'Available';
			break;
			case '2':
				return 'Disapproval';
			break;
			case '3':
				return 'Timeout';
			break;
			case '5':
				return 'Email notification';
			break;
			case '6':
				return 'Backorder';
			break;
			case '7':
				return 'Auction';
			break;
			case '10':
				return 'Registered(Backorder Allowed)';
			break;
			case '11':
				return 'Registered(Auction Allowed)';
			break;
			case '12':
				return 'Registered(Email Notification Allowed)';
			break;
			case '13':
				return 'Registry Premium Domain';
			break;
			default:
				return 'Unknown';
			break;
		}
	}
}
?>