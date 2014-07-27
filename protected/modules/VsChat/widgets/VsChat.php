<?php


class VsChat extends CWidget {

	/**
	* Name class model CActiveRecord
	* @var string
	*/
	public $modelClassName = 'User';
	
	/**
	* Name field key in user model 
	* @var string
	*/
	public $nameFiledKey = 'FullName';
	
	/**
	* Name table model
	* @var string
	*/
	public $tableName = 'VsChat';

	public function run(){
	
		//$users = CActiveRecord::model($this->modelClassName)->findAll();
		
		$this->render('_form', array(
			'url'=>Yii::app()->createAbsoluteUrl('VsChat') ,
		));
	}
	
	/**
	* Create table model
	*/
	public function createTable() {
		Yii::app()->db->createCommand()->createTable($this->tableName,array(
			'id'=>'integer PRIMARY KEY',
			'expire'=>'integer',
			'user_to'=>'integer',
			'user_from'=>'integer',
			'is_new'=>'boolean',
			'comment'=>'text',
		), 'ENGINE=InnoDB');
	}
}

?>