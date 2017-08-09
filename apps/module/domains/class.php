<?php
class domain_api extends Database {
	var $module;
	static $url_onamae_api = URL_ONAMAE_API;
	static $host_http_header = array(HOST_HEADER);
	static $username_api = ONAMAE_USERNAME;
	static $password_api = ONAMAE_PASSWORD;
	static $responseFormat = RESPONSE_FORMAT;
	static $paymentType = PAYMENT_TYPE;
	static $languageCode = LANGUAGE_CODE;
	public function __construct($params=NULL){
		$this->module = $params['module'];
		parent::__construct((empty($params['table']))?$module:$params['table']);
		if(isset($params['primary_key'])&&!empty($params['primary_key'])){
			$this->primary_key = $params['primary_key'];
		}
	}
	public function setEncryptHashKey($data){
		$key = 'GMOGPShopup746D7SCHAIQ0QUZ0MRJWU0PQ3AD7PJ8BONAMAIREGISTERDOMAIN';
		$key_encry = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,md5($key),$data,MCRYPT_MODE_CBC,md5(md5($key)))); 
		return $key_encry; 
	}
	public function setDecryptHashKey($data){
		$key = 'GMOGPShopup746D7SCHAIQ0QUZ0MRJWU0PQ3AD7PJ8BONAMAIREGISTERDOMAIN'; 
		$key_decry = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5($key),base64_decode($data),MCRYPT_MODE_CBC,md5(md5($key))),"\0");  
		return $key_decry; 
	}
	public function decrypt_blowfish($data,$key){
	    $iv = pack("H*" , substr($data,0,16));
	    $x = pack("H*" , substr($data,16));
	    $res = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $x , MCRYPT_MODE_CBC, $iv);
	    return $res;
	}
	public function encrypt_blowfish($data,$key){
	    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $crypttext = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_CBC, $iv);
	    return bin2hex($iv . $crypttext);
	}
	public function main_log_ip_check($data) {
		$this->sql = " insert into onamae_log (".implode(',',array_keys($data)).') values('.implode(',',$data).')';
		$this->insert();
		return $this->insertID();
	}
	public function log_query_fail($action_type,$status_text) {
		$status = 'Fail';
		$data = array(
			"main_log_id"=>$_SESSION['main_log_id'],
			"action_type"=>"'$action_type'",
			"status"=>"'$status'",
			"status_text"=>"'$status_text'",
			"cdate"=>"NOW()"
		);
		$this->sql = " insert into onamae_log_query (".implode(',',array_keys($data)).') values('.implode(',',$data).')';
		$this->insert();
		return $this->insertID();
	}
	public function log_query_success($action_type,$response,$status_text='null') {
		$status = 'Success';
		$data = array(
			"main_log_id"=>$_SESSION['main_log_id'],
			"action_type"=>"'$action_type'",
			"status"=>"'$status'",
			"status_text"=>"'$status_text'",
			"response"=>"'".json_encode($response)."'",
			"cdate"=>"NOW()"
		);
		$this->sql = " insert into onamae_log_query (".implode(',',array_keys($data)).') values('.implode(',',$data).')';
		$this->insert();
		return $this->insertID();
	}
	public function AuthsetOneCheckExpireToken_UsernameAuth($username,$password) {
		$this->sql = " select ip_allow from onamae_user where username = '$username' and password = '$password' ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function AuthsetOneCheckExpireToken_ExchangeToken($token) {
		$this->sql = " select ip_allow from onamae_user where token = '$token' ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function AuthsetOneCheckExpireToken($token) {
		$this->sql = " select ip_allow from onamae_user where token = '$token' and expire_token > now() ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function setOneCheckValidateUsername ($username) {
		$this->sql = " select user_id from onamae_user where username = '$username' ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function getOneOnamaeUsername($user_id) {
		$this->sql = " select token , expire_token , ip_allow from onamae_user where user_id = '$user_id' ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function setOneSaveInsertOnamaiUsername ($data) {
		$this->sql = " insert into onamae_user (".implode(',',array_keys($data)).') values('.implode(',',$data).')';
		$this->insert();
		return $this->insertID();
	}
	public function getOneToken ($username,$password) {
		$this->sql = " select token from onamae_user where username = '$username' and password = '$password' ";
		$this->select();
		$rows = $this->getRows();
		return $rows[0];
	}
	public function setOneExchangeToken ($token) {
		$this->sql = " select user_id , username , password , salt_key from onamae_user where token = '$token' ";
		$this->select();
		$rows = $this->getRows();
		if(!empty($rows)) {
			$user_id = $this->setInt($rows[0]['user_id']);
			$username = $this->getString($this->setDecryptHashKey($rows[0]['username']));
			$password = $this->getString($this->setDecryptHashKey($rows[0]['password']));
			$salt_key = $this->getString($this->setDecryptHashKey($rows[0]['salt_key']));
			$newtoken = $this->setString($this->encrypt_blowfish($username.$password,$salt_key));
			$last_update = date('Y-m-d');
			$expire_token = date('Y-m-d',strtotime("$last_update +7 day"));
			$this->sql = " update onamae_user set token = '$newtoken' , last_update = '$last_update' , expire_token = '$expire_token' where user_id = $user_id and token = '$token' ";
			$this->update();
			$response = array();
			$response['expire_token'] = $expire_token;
			$response['token'] = $newtoken;
			return $response;
		}
	}
	public function setOneCheckExpireToken ($token) {
		$this->sql = " select token , expire_token from onamae_user where token = '$token' ";
		$this->select();
		$rows = $this->getRows();
		if(!empty($rows)) {
			$response = array();
			$response['expire_token'] = $rows[0]['expire_token'];
			$response['token'] = $rows[0]['token'];
			return $response;
		}
	}
}
?>