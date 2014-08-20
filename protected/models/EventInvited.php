<?php

/**
 * This is the model class for table "EventInvited".
 *
 * The followings are the available columns in table 'EventInvited':
 * @property integer $event_id
 * @property integer $user_id
 */
class EventInvited extends CActiveRecord
{

	/**
	* @var boolean
	*/
	public $sendNotif = false;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{EventInvited}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, user_id', 'required'),
			array('event_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('event_id, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => 'Событие',
			'user_id' => 'Пользователь',
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

		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	* Делаем рассылку о добавлении
	*/
	protected function sendNotifAdd() { 
	
		$message = new Message();
		$message->user_id = $this->event->user_id;
		$message->user_to_id = $this->user_id;
		$message->datetime = time();
		$message->is_new = 1;
		$message->arhive = 0;
		$message->subject = ''.$this->event->typeEvent->name_msg.': '.$this->event->name.'';
		$message->text = 'Участие в "'.$this->event->typeEvent->name_msg.': '.$this->event->name.'"'
					.'<br/>Дата '.$this->event->dateevent.'; c '.$this->event->timestartStr().' по '.$this->event->timeendStr()
					. '<br/>'.CHtml::link('Подробно', array('/sEvent/event', 'id'=>$this->event_id));
		$message->save();
	}
	
	/** 
	*
	*/
	protected function afterSave() {
		if($this->isNewRecord && $this->sendNotif) {
			$this->sendNotifAdd();
		}
		return parent::afterSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventInvited the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
