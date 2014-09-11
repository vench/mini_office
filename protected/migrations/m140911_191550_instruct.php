<?php

class m140911_191550_instruct extends CDbMigration
{
	public function up()
	{
            //привязка к событию
            $this->addColumn('{{Instruct}}', 'event_id', 'int');
            
            //
            $this->addForeignKey('event_id_id', '{{Instruct}}', 'event_id', '{{Event}}', 'id', 'SET NULL', 'SET NULL');
	}

	public function down()
	{
		echo "m140911_191550_instruct does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}