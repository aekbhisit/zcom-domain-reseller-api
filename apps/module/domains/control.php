<?php
require 'apps/lib/function.inc.php';
require 'apps/module/domains/class.php';
require 'apps/module/domains/onamae_class.php';
require 'apps/module/domains/onamae/autoloader.php';
$obj = array(
    'module'=>'domains',
    'table'=>'domains',
    'primary_key'=>'domain_id',
);
$oModule = new domain_api($obj);
$oOnamae = new core_api();
// $app->post('/CreateUser',$oAuthOwnerIP($oModule),function() use ($app,$oModule) {
// 	$allPostVars = $app->request->post();
// 	if(!isset($allPostVars["username"])||!isset($allPostVars["password"])||!isset($allPostVars["ip_address"])) {

// 		$app->response->setStatus(404);
// 		exit;
// 	}
// 	if(empty($allPostVars["username"])||$allPostVars["username"]==='') {
// 		$app->response->setStatus(404);
// 		exit;
// 	}
// 	if(empty($allPostVars["password"])||$allPostVars["password"]==='') {
// 		$app->response->setStatus(404);
// 		exit;
// 	}
// 	if(empty($allPostVars["ip_address"])||$allPostVars["ip_address"]==='') {
// 		$app->response->setStatus(404);
// 		exit;
// 	}
// 	$ip_address = $oModule->setString($allPostVars["ip_address"]);
// 	$ip_remote_add = $oModule->setString($_SERVER['REMOTE_ADDR']);
// 	$username = $oModule->setEncryptHashKey($oModule->setString($allPostVars["username"]));
// 	$password = $oModule->setEncryptHashKey($oModule->setString($allPostVars["password"]));
// 	$validation_username = $oModule->setOneCheckValidateUsername($username);
// 	if(!empty($validation_username)) {
// 		$app->response->setStatus(404);
// 		exit;
// 	}
// 	$salt_key = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",35)),0,35);
// 	$token = $oModule->setString($oModule->encrypt_blowfish($username.$password,$salt_key));
// 	$salt_key = $oModule->setEncryptHashKey($oModule->setString($salt_key));
// 	$last_update = date('Y-m-d H:i:s');
// 	$expire_token = date($last_update,strtotime("+7 day"));
// 	$data = array(
// 		"username"=>"'$username'",
// 		"password"=>"'$password'",
// 		"salt_key"=>"'$salt_key'",
// 		"token"=>"'$token'",
// 		"premission_id"=>3,
// 		"expire_token"=>"'$expire_token'",
// 		"last_update"=>"'$last_update'",
// 		"ip_allow"=>"'$ip_address'",
// 		"ip_remote_add"=>"'$ip_remote_add'",
// 	);
// 	$response = $oModule->setOneSaveInsertOnamaiUsername($data);
// 	if(isset($response)) {
// 		$response = $oModule->getOneOnamaeUsername($response);
// 		$res = array();
// 		$res['result'] = 'ok';
// 		$res['data'] = $response;
// 		echo json_encode($res);
// 	}
// });
$app->post('/GetToken',$oAuthIPGetToken($oModule),function() use ($app,$oModule) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["username"])) {
		$status_text = 'Not isset username';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["password"])) {
		$status_text = 'Not isset password';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$username = $oModule->setEncryptHashKey($oModule->setString($allPostVars["username"]));
	$password = $oModule->setEncryptHashKey($oModule->setString($allPostVars["password"]));
	$response = $oModule->getOneToken($username,$password);
	if(!empty($response)) {
		$res = array();
		$res['responseBean']['result']['actionType'] = $task_name;
		$res['responseBean']['result']['resultCode'] = 10000;
		$res['responseBean']['result']['resultMsg'] = 'Command completed successfully.';
		$res['responseBean']['body'] = $response;
		$oModule->log_query_success($task_name,$res,'Request Success');
		echo json_encode($res);
	} else {
		$res = array();
		$res['responseBean']['result']['actionType'] = $task_name;
		$res['responseBean']['result']['resultCode'] = 200000;
		$res['responseBean']['result']['resultMsg'] = 'Failed in command with error.';
		$oModule->log_query_success($task_name,array('result'=>'Fail','data'=>$allPostVars),'Request failure');
		echo json_encode($res);
	}
});
$app->post('/ExchangeToken',$oAuthIPExchangeToken($oModule),function() use ($app,$oModule) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["token"])) {
		$status_text = 'Not isset token';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$token = $oModule->setString($allPostVars["token"]);
	$response = $oModule->setOneExchangeToken($token);
	if(!empty($response)) {
		$res = array();
		$res['responseBean']['result']['actionType'] = $task_name;
		$res['responseBean']['result']['resultCode'] = 10000;
		$res['responseBean']['result']['resultMsg'] = 'Command completed successfully.';
		$res['responseBean']['body'] = $response;
		$oModule->log_query_success($task_name,$res,'Request Success');
		echo json_encode($res);
	} else {
		$res = array();
		$res['responseBean']['result']['actionType'] = $task_name;
		$res['responseBean']['result']['resultCode'] = 200000;
		$res['responseBean']['result']['resultMsg'] = 'Failed in command with error.';
		$oModule->log_query_success($task_name,array('result'=>'Fail','data'=>$allPostVars),'Request failure');
		echo json_encode($res);
	}
});
$app->post('/CheckExpireToken',$oAuthIPExchangeToken($oModule),function() use ($app,$oModule) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["token"])) {
		$status_text = 'Not isset token';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$token = $oModule->setString($allPostVars["token"]);
	$response = $oModule->setOneCheckExpireToken($token);
	if(!empty($response)) {
		$res = array();
		$res['responseBean']['result']['actionType'] = $task_name;
		$res['responseBean']['result']['resultCode'] = 10000;
		$res['responseBean']['result']['resultMsg'] = 'Command completed successfully.';
		$res['responseBean']['body'] = $response;
		$oModule->log_query_success($task_name,$res,'Request Success');
		echo json_encode($res);
	} else {
		$oModule->log_query_success($task_name,array('result'=>'Fail','data'=>$allPostVars),'Request failure');
	}
});
$app->post('/DomainCheck',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domain"])) {
		$status_text = 'Not isset domain';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["tld"])) {
		$status_text = 'Not isset tld';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainCreate',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domainName';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["period"])&&!isset($allPostVars["periods"])) {
		$status_text = 'Not isset period';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["autoRenew"])&&!isset($allPostVars["autoRenews"])) {
		$status_text = 'Not isset autoRenew';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["proxyflg"])&&!isset($allPostVars["proxyflgs"])) {
		$status_text = 'Not isset proxyflg';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(empty($allPostVars["ns"])) {
		$status_text = 'Not isset ns';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainInfo',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domainName and domainId';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainRenew',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["curExpDate"])&&!isset($allPostVars["curExpDates"])) {
		$status_text = 'Not isset curExpDate or curExpDatess';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["period"])&&!isset($allPostVars["periods"])) {
		$status_text = 'Not isset period or periods';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["autoRenew"])&&!isset($allPostVars["autoRenews"])) {
		$status_text = 'Not isset period or autoRenews';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainUpdate',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainUpdateTransfer',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainUpdateTransferCancel',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/TldList',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/PendingQuery',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["pendingId"])) {
		$status_text = 'Not isset pendingId';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainDelete',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/RegistryWhoisInfo',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainRestore',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==11000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/WhoisProxy',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainCancelDelete',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainSwitch',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/MatchDomainCreate',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])&&!isset($allPostVars["domainIds"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/ClaimNoticeInfo',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DsRecordEdit',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DsRecordList',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/ResultQuery',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["receiptNo"])) {
		$status_text = 'Not isset receiptNo';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/OrdersBatchResultQuery',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["batchId"])) {
		$status_text = 'Not isset batchId';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/DomainCreateValidator',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainName"])&&!isset($allPostVars["domainNames"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["period"])&&!isset($allPostVars["periods"])) {
		$status_text = 'Not isset period';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["ns"])) {
		$status_text = 'Not isset ns';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["autoRenew"])&&!isset($allPostVars["autoRenews"])) {
		$status_text = 'Not isset autoRenew';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["proxyflg"])&&!isset($allPostVars["proxyflgs"])) {
		$status_text = 'Not isset proxyflg';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["RegistryPremium"])&&!isset($allPostVars["RegistryPremiums"])) {
		$status_text = 'Not isset RegistryPremium';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/RegistryPremiumDomainPrice',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["period"])) {
		$status_text = 'Not isset period';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["command"])) {
		$status_text = 'Not isset command';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
$app->post('/ReleaseApiDomain',$oAuthIP($oModule),function() use ($app,$oModule,$oOnamae) {
	$resourceuri = $app->request->getResourceUri();
	$task = explode('/',$resourceuri);
	$task_name = $task[count($task)-1];
	$allPostVars = $app->request->post();
	if(!isset($allPostVars["domainId"])&&!isset($allPostVars["domainName"])) {
		$status_text = 'Not isset domain Data';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	if(!isset($allPostVars["userPassword"])) {
		$status_text = 'Not isset userPassword';
		$oModule->log_query_fail($task_name,$status_text);
		$app->halt(500);
	}
	$response = $oOnamae->onamae_checkTask('onamae_'.strtolower($task_name),$allPostVars);
	if($response['responseBean']['result']['resultCode']==10000) { $oModule->log_query_success($task_name,$response,'Request Success'); }
	else { $oModule->log_query_success($task_name,$response,'Request failure'); }
	echo json_encode($response);
});
?>