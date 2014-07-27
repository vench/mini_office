<?php

/**
 * This is the model class for table "Message".
 *
 * The followings are the available columns in table 'Message':
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_to_id
 * @property integer $datetime
 * @property integer $is_new
 * @property string $subject
 * @property string $text
 *
 * The followings are the available model relations:
 * @property User $userTo
 * @property User $user
 */
class Message extends CActiveRecord
{
 


        /**
         *
         * @var type 
         */
        public $agrValue;


        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, text', 'required'),
			array('user_id, user_to_id, datetime, is_new,arhive', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_to_id, datetime, is_new, subject, text', 'safe', 'on'=>'search'),
		);
	}
        
        /**
         * 
         * @return type
         */
        public function datetimeStr() {
            return date('d.m.Y', $this->datetime);
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userTo' => array(self::BELONGS_TO, 'User', 'user_to_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Кто создал',
			'user_to_id' => 'Кому',
			'datetime' => 'Дата',
			'is_new' => 'Новое',
			'subject' => 'Тема',
			'text' => 'Сообщение',
                        'arhive'=>'Архивное',
		);
	}
        
        public function isArhive() {
            return $this->arhive == 1;
        }

        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_to_id',$this->user_to_id);
		$criteria->compare('datetime',$this->datetime);
		//$criteria->compare('is_new',$this->is_new);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('text',$this->text,true);
                $criteria->compare('arhive',$this->arhive,true); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'is_new DESC, datetime DESC',
                          )
		));
	}
        
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * 
         * @return boolean
         */
        protected function beforeSave() {
            if($this->isNewRecord) {
                $this->datetime = time();
            }
            return parent::beforeSave();
        }
}
