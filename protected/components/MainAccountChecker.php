<?php 

/**
* MainAccountChecker
*/
class MainAccountChecker 
{
	private $returned_message;
	public function check()
	{
		$curlURL = "";
		$curlres = curl_init();
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		$this->returned_message = curl_exec($curlres);

	}
	public function isActive()
	{
		
	}
}