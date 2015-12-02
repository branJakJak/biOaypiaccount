<?php

class m151202_190142_add_date_cols extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn("tbl_main_account","date_created","datetime");
		$this->addColumn("tbl_main_account","date_updated","datetime");
	}

	public function safeDown()
	{
		$this->dropColumn("tbl_main_account","date_created");
		$this->dropColumn("tbl_main_account","date_updated");
	}
}