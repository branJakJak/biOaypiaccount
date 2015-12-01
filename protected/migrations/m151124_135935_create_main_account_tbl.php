<?php

class m151124_135935_create_main_account_tbl extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable("tbl_main_account", array(
            "id"=>"pk",
            "status"=>"string default 'unconfirmed' ",
            "company_name"=>"string",
            "company_website"=>"string",
            "contact_person"=>"string",
            "username"=>"string",
            "password"=>"string",
            "retype_password"=>"string",
            "street"=>"string",
            "house_number"=>"string",
            "post_code"=>"string",
            "city"=>"string",
            "country"=>"string",
            "fax"=>"string",
            "phone_number"=>"string",
            "email_address"=>"string",
        ));

	}
	public function safeDown()
	{
        $this->dropTable("tbl_main_account");
	}
}