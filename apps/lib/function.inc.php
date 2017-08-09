<?php
if(!function_exists('http_response_code')) {
	function http_response_code($code = NULL) {
		if($code !== NULL) {
			switch ($code) {
				case 100: $text = 'Continue'; break;
				case 101: $text = 'Switching Protocols'; break;
				case 200: $text = 'Success'; break;
				case 201: $text = 'Created'; break;
				case 202: $text = 'Accepted'; break;
				case 203: $text = 'Non-Authoritative Information'; break;
				case 204: $text = 'No Content'; break;
				case 205: $text = 'Reset Content'; break;
				case 206: $text = 'Partial Content'; break;
				case 300: $text = 'Multiple Choices'; break;
				case 301: $text = 'Moved Permanently'; break;
				case 302: $text = 'Moved Temporarily'; break;
				case 303: $text = 'See Other'; break;
				case 304: $text = 'Not Modified'; break;
				case 305: $text = 'Use Proxy'; break;
		 		case 400: $text = 'Bad Request'; break;
				case 401: $text = 'Unauthorized'; break;
				case 402: $text = 'Payment Required'; break;
				case 403: $text = 'Forbidden'; break;
				case 404: $text = 'Not Found'; break;
				case 405: $text = 'Method Not Allowed'; break;
				case 406: $text = 'Not Acceptable'; break;
				case 407: $text = 'Proxy Authentication Required'; break;
				case 408: $text = 'Request Time-out'; break;
				case 409: $text = 'Conflict'; break;
				case 410: $text = 'Gone'; break;
				case 411: $text = 'Length Required'; break;
				case 412: $text = 'Precondition Failed'; break;
				case 413: $text = 'Request Entity Too Large'; break;
				case 414: $text = 'Request-URI Too Large'; break;
				case 415: $text = 'Unsupported Media Type'; break;
				case 500: $text = 'Internal Server Error'; break;
				case 501: $text = 'Not Implemented'; break;
				case 502: $text = 'Bad Gateway'; break;
				case 503: $text = 'Service Unavailable'; break;
				case 504: $text = 'Gateway Time-out'; break;
				case 505: $text = 'HTTP Version not supported'; break;
				default:
			    	exit('Unknown http status code "' . htmlentities($code) . '"');
				break;
			}
		}
		return $text;
	}
}
function getAPIresponseData($status,$message,$data){
	$status_text = http_response_code($status);
	$response = array(
		'status'=>$status,
		'status_text'=>$status_text,
		'message'=>$message,
		'data'=>$data
		);
	return $response;
}
// $oAuthtication = function ($oModule) {
// 	return function () use ($oModule) {
// 		$app = \Slim\Slim::getInstance();
// 		switch($app->request->getMethod()) {
// 			case 'GET':
// 				$obj = explode('/',$app->environment['PATH_INFO']);
// 				$api_key = $oModule->setString($obj[3]);
// 				$user = $oModule->setString($obj[4]);
// 				$password = $oModule->setString($obj[5]);
// 			break;
// 			case 'POST':
// 			case 'PUT':
// 			case 'DELETE':
// 				$objpost = $app->request->post();
// 				$api_key = $oModule->setString($objpost['api_key']);
// 				$user = $oModule->setString($objpost['user_api']);
// 				$password = $oModule->setString($objpost['pass_api']);
// 			break;
// 		}
// 		$check = $oModule->CheckUserPassAccess($api_key,$oModule->encrypt($user),$oModule->encrypt($password));
// 		if(empty($check)) {
// 			$app->response->setStatus(401);
// 			echo json_encode(getAPIresponseData($app->response->getStatus(),'Error. username or password or api key not match.',''));
// 			exit;
// 		}else{
// 			$_SESSION['DATA_CHECK_AUTH'] = $check;
// 		}
// 	};
// };
$oAuthOwnerIP = function ($oModule) {
	return function () use ($oModule) {
		$app = \Slim\Slim::getInstance();
		if($app->request->getMethod()==='POST') {
			$req = $app->request;
			if($req->getIp()==='203.170.193.202') {
				$app->response->setStatus(200);
			} else {
				$app->response->setStatus(404);
				exit;
			}
		} else {
			$app->response->setStatus(404);
			exit;
		}
	};
};
$oAuthIP = function ($oModule) {
	return function () use ($oModule) {
		$app = \Slim\Slim::getInstance();
		if($app->request->getMethod()==='POST') {
			$req = $app->request;
			$post = $app->request->post();
			if(!isset($post['token'])) {
				$data = array(
					"action_type"=>"'Not Isset Token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
			$token = $oModule->setString($post['token']);	
			if($token=='') {
				$data = array(
					"action_type"=>"'Empty Token'",
					"token"=>"'$token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
			$response = $oModule->AuthsetOneCheckExpireToken($token);
			if(!empty($response)) {
				$ip_allow = $response['ip_allow'];
				$ip_allow = explode(',',$ip_allow);
				if(in_array($req->getIp(),$ip_allow)) {
					$data = array(
						"action_type"=>"'Ip Allow'",
						"token"=>"'$token'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$_SESSION['main_log_id'] = $oModule->main_log_ip_check($data);
				} else {
					$data = array(
						"action_type"=>"'Ip Not Allow'",
						"token"=>"'$token'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$oModule->main_log_ip_check($data);
					$app->halt(500);
				}
			} else {
				$data = array(
					"action_type"=>"'Token Not Match'",
					"token"=>"'$token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
		}
	};
};
$oAuthIPExchangeToken = function ($oModule) {
	return function () use ($oModule) {
		$app = \Slim\Slim::getInstance();
		if($app->request->getMethod()==='POST') {
			$post = $app->request->post();
			$req = $app->request;
			$post = $app->request->post();
			if(!isset($post['token'])) {
				$data = array(
					"action_type"=>"'Not Isset Token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
			$token = $oModule->setString($post['token']);	
			if($token=='') {
				$data = array(
					"action_type"=>"'Empty Token'",
					"token"=>"'$token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
			$response = $oModule->AuthsetOneCheckExpireToken_ExchangeToken($token);
			if(!empty($response)) {
				$ip_allow = $response['ip_allow'];
				$ip_allow = explode(',',$ip_allow);
				if(in_array($req->getIp(),$ip_allow)) {
					$data = array(
						"action_type"=>"'Ip Allow ExchangeToken'",
						"token"=>"'$token'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$_SESSION['main_log_id'] = $oModule->main_log_ip_check($data);
				} else {
					$data = array(
						"action_type"=>"'Ip Not Allow ExchangeToken'",
						"token"=>"'$token'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$oModule->main_log_ip_check($data);
					$app->halt(500);
				}
			} else {
				$data = array(
					"action_type"=>"'Token Not Match'",
					"token"=>"'$token'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
		}
	};
};
$oAuthIPGetToken = function ($oModule) {
	return function () use ($oModule) {
		$app = \Slim\Slim::getInstance();
		if($app->request->getMethod()==='POST') {
			$post = $app->request->post();
			$username = $oModule->setEncryptHashKey($oModule->setString($post["username"]));
			$password = $oModule->setEncryptHashKey($oModule->setString($post["password"]));
			$response = $oModule->AuthsetOneCheckExpireToken_UsernameAuth($username,$password);
			$req = $app->request;
			if(!empty($response)) {
				$ip_allow = $response['ip_allow'];
				$ip_allow = explode(',',$ip_allow);
				if(in_array($req->getIp(),$ip_allow)) {
					$data = array(
						"action_type"=>"'Ip Allow GetToken'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$_SESSION['main_log_id'] = $oModule->main_log_ip_check($data);
				} else {
					$data = array(
						"action_type"=>"'Ip Not Allow GetToken'",
						"host"=>"'".$req->getHost()."'",
						"url"=>"'".$req->getUrl()."'",
						"request_path"=>"'".$req->getPath()."'",
						"ip_address"=>"'".$req->getIp()."'",
						"referrer"=>"'".$req->getReferrer()."'",
						"useragent"=>"'".$req->getUserAgent()."'",
						"contentlength"=>"'".$req->getContentLength()."'",
						"response"=>"'".json_encode($response)."'",
						"cdate"=>"NOW()"
					);
					$oModule->main_log_ip_check($data);
					$app->halt(500);
				}
			} else {
				$data = array(
					"action_type"=>"'Username Or Password Not Found'",
					"host"=>"'".$req->getHost()."'",
					"url"=>"'".$req->getUrl()."'",
					"request_path"=>"'".$req->getPath()."'",
					"ip_address"=>"'".$req->getIp()."'",
					"referrer"=>"'".$req->getReferrer()."'",
					"useragent"=>"'".$req->getUserAgent()."'",
					"contentlength"=>"'".$req->getContentLength()."'",
					"cdate"=>"NOW()"
				);
				$oModule->main_log_ip_check($data);
				$app->halt(500);
			}
		}
	};
};
?>