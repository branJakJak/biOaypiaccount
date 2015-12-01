<?php

class m151124_140306_create_sub_account_tbl extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable("tbl_sub_account",array(
				"id"=>"pk",
				"main_account"=>"integer",
				"username"=>"string",
				"password"=>"string",
				"status"=>"string default 'inactive'",
			));
        $this->addForeignKey("main_account_fk", "tbl_sub_account", "main_account", "tbl_main_account", "id", "CASCADE", "CASCADE");
	}

	public function safeDown()
	{
        $this->dropForeignKey("main_account_fk", "tbl_sub_account");
		$this->dropTable("tbl_sub_account");
	}

}