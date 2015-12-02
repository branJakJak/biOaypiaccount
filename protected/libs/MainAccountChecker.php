<?php 

/**
* MainAccountChecker
*/
class MainAccountChecker
{
	public function isActive(MainAccount $account)
	{
		$isActive = false;
		$curlURL = "https://www.voipinfocenter.com/API/Request.ashx?";
		$httpParams = array(
			"command"=>"changeuserinfo",
			"username"=>$account->username,
			"password"=>$account->password,
			"customer"=>"test",
			"customerpassword"=>"test",
			"customerblocked"=>'true',
		);
		$curlURL .= http_build_query($httpParams);
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
		$curlResRaw = curl_exec($curlres);
		$xmlObj = simplexml_load_string($curlResRaw);
		if (isset($xmlObj->Reason) && ( (string)$xmlObj->Reason ) == 'Unknown customer') {
			$isActive = true;
		}
		return $isActive;
	}
}