<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://test-des.onamae.com/des/Execute.do');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: test-des.onamae.com'));
curl_setopt($ch, CURLOPT_PORT, 443);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$params = array(
	"loginId"=>"testzcomth2",
	"loginPassword"=>"afafaf232x!",
	"actionType"=>"DomainCheck",
	"responseFormat"=>"json",
	"domain"=>"shopup",
	"tld"=>"com"
);
$query_string = http_build_query($params);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
print_r(curl_exec($ch));
if (curl_errno($ch)) {
	throw new Exception(curl_error($ch));
}
curl_close($ch);
exit;
// class onamaiDomain {
// 	var $username = "testzcomth2";
// 	var $password = "afafaf232x!";
// 	var $cookieset;
// 	var $rollnameserver;
// 	var $xml;
// 	var $xml_str;
// 	var $signature;
// 	var $genxml;
// 	var $module;
// 	var $forward;
	
// 	var $arecords;
// 	var $aaaarecords;
// 	var $cnamerecords;
// 	var $mxrecords;
// 	var $srvrecords;
// 	var $txtrecoreds;
// 	var $addressadmindata;

// 	var $customer_id;
// 	public function __construct($mode=NULL,$cookie=NULL,$ns=NULL,$forward=NULL,$arecord=NULL,$aaaarecord=NULL,$cnamerecord=NULL,$mxrecord=NULL,$srvrecord=NULL,$txtrecord=NULL,$address=NULL,$cus_id=null) {
// 		// if($mode!=NULL)
// 		// {
// 		// 	$this->module = $mode;
// 		// 	$this->domain = $_SESSION['domain_name_edit_manage'];
// 		// 		if($cookie!="" && $cookie!=NULL)
// 		// 		{
// 		// 			$this->cookieset = $cookie;
// 		// 		}
// 		// 		if($ns!="" && $ns!=NULL)
// 		// 		{
// 		// 			$this->rollnameserver = $ns;
// 		// 		}
// 		// 		if($forward!="" && $forward!=NULL)
// 		// 		{
// 		// 			$this->forward = $forward;
// 		// 		}
// 		// 		if($mode=='sethostrecords')
// 		// 		{
// 		// 			$this->setparamiterhostrecords($arecord,$aaaarecord,$cnamerecord,$mxrecord,$srvrecord,$txtrecord);
// 		// 		}
// 		// 		if($mode=='setcontactinfo' && $address!=null)
// 		// 		{
// 		// 			$this->addressadmindata = $address;
// 		// 		}
// 		// 		if($mode=='istocowchkexpire' && $cus_id!=null && !empty($cus_id))
// 		// 		{
// 		// 			$this->customer_id = $cus_id;
// 		// 		}
// 		// 		else
// 		// 		{
// 		// 			$this->customer_id = $_SESSION['customer_id'];
// 		// 		}
// 		// 	$this->gencorexml();
// 		// }
// 	}
// 	private function gencorexml()
// 	{
// 		switch($this->module)
// 		{
// 			case 'istocow':
// 				$this->genxml = '<item key="protocol">XCP</item>';
// 				$this->genxml .= '<item key="action">belongs_to_rsp</item>';
// 				$this->genxml .= '<item key="object">domain</item>';
// 				$this->genxml .= '<item key="attributes">';
// 				$this->genxml .= '<dt_assoc>';
// 				$this->genxml .= '<item key="domain">'.$this->domain.'</item>';
// 				$this->genxml .= '</dt_assoc>';
// 				$this->genxml .= '</item>';
// 			break;
// 			default:
				
// 			break;
// 		}
// 	}
// 	private function getDataSentXML() {
// 		$host = "test-des.onamae.com";
// 		$port = 443;
// 		$url = "https://test-des.onamae.com/des/Execute.do";
// 		$header = "";
// 		$header .= "POST $url HTTP/1.0\r\n";
// 		$header .= "Content-Type: text/xml\r\n";
// 		$header .= "X-Username: " . $this->username . "\r\n";
// 		$header .= "X-Password: " . $this->password . "\r\n";
// 		$header .= "Content-Length: " . strlen($this->xml) . "\r\n\r\n";
// 		# ssl:// requires OpenSSL to be installed
// 		$fp = fsockopen ("ssl://$host", $port, $errno, $errstr, 120);
// 		//echo "<pre>";
// 		if (!$fp) {
// 			print "HTTP ERROR!";
// 			echo $errno .' '. $errstr ;
// 		} else {
// 			# post the data to the server
// 			fputs ($fp, $header . $this->xml);
// 			$chk_line = 0 ;
// 			$this->xml_str = '';
// 			while (!feof($fp)) 
// 			{
// 				$chk_line++;
// 				$res = fgets ($fp, 1024);
// 				if($chk_line>6){
// 					$this->xml_str .= $res ; // htmlentities($res,ENT_XML1) ;
// 				}
// 			}
// 			fclose ($fp);
// 			$this->loadstrxml();
// 		}
// 	}
// 	private function loadstrxml() {
// 		$this->xml = simplexml_load_string((string)$this->xml_str);
// 		print_r($this->xml);
// 	}
// 	public function setXMLClass() {
// 		$this->xml = 	'<?xml version="1.0" encoding="UTF-8" standalone="no"';
// 		$this->xml .=	'<!DOCTYPE OPS_envelope SYSTEM "ops.dtd">';
// 		$this->xml .=	'<OPS_envelope><header><version>0.9</version></header><body><data_block><dt_assoc>';
// 		$this->xml .= 	$this->genxml;
// 		$this->xml .=	'</dt_assoc></data_block></body></OPS_envelope>';
// 		$this->getsignature();
// 		$this->getDataSentXML();
// 		$this->genResult();
// 		return $this->xml;	
// 	}
// 	private function getsignature() {
// 		//$this->signature = md5(md5($this->xml.$this->private_key).$this->private_key);
// 	}
// 	public function setparamiterhostrecords($arecord=NULL,$aaaarecord=NULL,$cnamerecord=NULL,$mxrecord=NULL,$srvrecord=NULL,$txtrecord=NULL) {
// 	}
// 	private function genResult($cal=1) {
// 	}
// }
// $onamai = new onamaiDomain();
?>