<?php

/**
 * Class MainAccountModelTest
 * @property MainAccountModel $mainAccountModel
 */
class MainAccountModelTest extends CDbTestCase {
    public $mainAccountModel;
    protected function setUp()
    {
        $this->mainAccountModel = new MainAccountModel();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
    public function testInit()
    {
        $this->mainAccountModel->save();
        $this->assertNotNull($this->mainAccountModel->username, "Asserting that username is not null and is populated");



    }


}
