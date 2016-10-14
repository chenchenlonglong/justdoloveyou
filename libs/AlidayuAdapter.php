<?php
namespace app\libs;

use app\libs\Functions;

require(__DIR__ . '/alidayu/TopSdk.php');

class AlidayuAdapter
{
	private $appkey;
	private $secret;
	private $client;
	
	public function __construct($key, $sec)
	{
		$this->appkey = $key;
		$this->secret = $sec;
		$this->client = new \TopClient;
    	$this->client->appkey = $this->appkey;
    	$this->client->secretKey = $this->secret;
    	$this->client->format = 'json';
	}
	
	public function send_msg_with_templete($mobile, $template_id, $param_json, $sign_name, $extend = '')
	{
		$req = new \AlibabaAliqinFcSmsNumSendRequest;
		$req->setSmsType("normal");
		$req->setExtend($extend);
		$req->setSmsFreeSignName($sign_name);
		$req->setSmsParam($param_json);
		$req->setRecNum($mobile);
		$req->setSmsTemplateCode($template_id);
		$resp = $this->client->execute($req);
				
		$sms_ok = 0;
		if(isset($resp->err_code) && $resp->err_code != 0)
			$sms_ok = array('code' =>32006, 'alidayu' => $resp);
		else if(isset($resp->code) && $resp->code != 0)
			$sms_ok = array('code' =>32006, 'alidayu' => $resp);
		return $sms_ok;
	}
}