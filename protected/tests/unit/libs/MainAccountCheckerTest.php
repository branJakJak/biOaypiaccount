<?php 

/**
* MainAccountCheckerTest
*/
class MainAccountCheckerTest extends CDbTestCase
{
	public $checker;
	public function setUp()
	{
		$this->checker = new MainAccountChecker();
	}
	public function tearDown()
	{
		$this->checker = null;
	}
	public function testIsActive()
	{
		$validAcct = new MainAccount();
		$validAcct->username = "qWilkinson";
		$validAcct->password = "LJ7J2kBwdX";
		$this->assertTrue($this->checker->isActive($validAcct), 'Valid account should be regarded as valid because it exists in the api');
		$invalid = new MainAccount();
		$invalid->username = "_";
		$invalid->password = "_";
		$this->assertFalse($this->checker->isActive($invalid), 'Asserting that invalid account object returns false');
	}


}