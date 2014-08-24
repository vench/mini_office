<?php

/**
 * This is the model class for table "Instruct".
 *
 * The followings are the available columns in table 'Instruct':
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_to_id
 * @property integer $datecreate
 * @property integer $status
 * @property string $name
 * @property string $description
 * @property integer $deadline
 *
 * The followings are the available model relations:
 * @property User $userTo
 * @property User $user
 */
class Instruct extends CActiveRecord
{
	
	const STATUS_START = 1;	
	const STATUS_END = 2;	
	const STATUS_WORK = 3;	
	const STATUS_BREAK = 4;
	
	/**
	 * Получить список статусов
	 * @return array 
	 */
	public static function getStatusList() {
		return array(
			self::STATUS_START=>'Новое поручение',
			self::STATUS_END=>'Поручение выполнено',
			self::STATUS_WORK=>'Поручение в работе',
			self::STATUS_BREAK=>'Поручение отклонено',
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Instruct';
	}
	
	/**
	* Список допустимых статусов для смены
	* @return array
	*/
	public function getMayStatusList($all = false) {
		$list = array();
		$data = self::getStatusList();
		foreach($data as $key=>$name) {
			$add = false;
			if($this->status == self::STATUS_START && ($key == self::STATUS_END || $key == self::STATUS_WORK || $key == self::STATUS_BREAK)) {
				$add = true;
			}
			if($this->status == self::STATUS_END) { }
			if($this->status == self::STATUS_WORK && ($key == self::STATUS_BREAK || $key == self::STATUS_END)) { 
				$add = true;
			}
			if($this->status == self::STATUS_BREAK) { }
			if($add || $all) {
				$list[$key] = $name;
			}
		}
		return $list;
	}
	
	/**
	*@return string
	*/
	public function getStatusText() {
		$data = self::getStatusList();
		return isset($data[$this->status]) ? $data[$this->status] : ""; 
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, user_to_id, datecreate,deadline, name, description', 'required'),
			array('user_id, user_to_id, datecreate, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_to_id, datecreate, status, name, description', 'safe', 'on'=>'search'),
		);
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
			'user_id' => 'Назначил',
			'user_to_id' => 'Ответственный',
			'datecreate' => 'Дата создания',
			'status' => 'Статус',
			'name' => 'Название',
			'description' => 'Описание',
			'deadline'=>'Крайний срок',
		);
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
		$criteria->compare('datecreate',$this->datecreate);
		$criteria->compare('status',$this->status);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		
		$criteria->order = 'deadline desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	* Разослать уведомления
	*/
	public function sendMessages() {
		$message = new Message();
		$message->user_id = $this->user_id;
		$message->user_to_id = $this->user_to_id;
		$message->datetime = time();
		$message->is_new = 1;
		$message->arhive = 0;
		$message->subject = 'Новое поручение';
		$message->text = 'Вы получили новое поручение "'.$this->name.'"'.'<br>'.CHtml::link('Просмотреть подробно', Yii::app()->createAbsoluteUrl('/instruct', array('from'=>1)));
		$message->save();
	}
	
	        /**
         * 
         * @return type
         */
    protected function beforeSave() {
            if($this->isNewRecord) {
               $this->status = self::STATUS_START;
            }
            $this->deadline = strtotime($this->deadline); 
            return parent::beforeSave();
    }
	
	        /**
         * 
         * @return type
         */
    protected function afterFind() {
            if(is_null($this->deadline)) {
                $this->deadline = time();
            }
            $this->deadline = date('d.m.Y', $this->deadline); 
			$this->datecreate = date('d.m.Y', $this->datecreate);
			
            return parent::afterFind();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Instruct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
