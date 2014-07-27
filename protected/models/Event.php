<?php

/**
 * This is the model class for table "Event".
 *
 * The followings are the available columns in table 'Event':
 * @property integer $id
 * @property integer $user_id
 * @property integer $place_id
 * @property integer $type_event_id
 * @property integer $dateevent
 * @property integer $dateevent2
 * @property integer $timestart
 * @property integer $timeend
 * @property string $name
 * @property string $description
 * @property string $show_all
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Place $place
 * @property EventType $typeEvent
 * @property User[] $users
 */
class Event extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Event}}';
	}
        
        /**
         * 
         * @return string
         */
        public function dateeventInfo() {
            return $this->dateevent. (($this->cyclic == 1) ? ': каждый '.Utill::getWeekDayStr(date('w',strtotime($this->dateevent))) : '');
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dateevent,dateevent2, timestart, timeend, name, description', 'required'),
			array('user_id, place_id, type_event_id ', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
                        array('cyclic,show_all', 'boolean'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, place_id, type_event_id, dateevent, timestart, timeend, name, description,dateevent2', 'safe', 'on'=>'search'),
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
			'place' => array(self::BELONGS_TO, 'Place', 'place_id'),
			'typeEvent' => array(self::BELONGS_TO, 'EventType', 'type_event_id'),
			'users' => array(self::MANY_MANY, 'User', 'EventInvited(event_id, user_id)'),
		);
	} 
	
	public function getUsersList() {
		$users = array();
		foreach($this->users as $user) {
			$users[] = $user->getFullName();
		}
		return join('<br/>', $users);
 	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Создатель',
			'place_id' => 'Место',
			'type_event_id' => 'Тип события',
			'dateevent' => 'Дата',
			'timestart' => 'Время начала',
			'timeend' => 'Время окончания',
			'name' => 'Название',
			'description' => 'Описание',
                        'cyclic'=>'Регулярное',
                        'show_all'=>'Доступно всем',
						'dateevent2'=>'Дата завершения',
		);
	}
        
        /**
         * 
         * @return string
         */
        public function timestartStr() {
            return $this->timeCutSec($this->timestart);
        }
        
        /**
         * 
         * @return string
         */
        public function timeendStr() {
            return $this->timeCutSec($this->timeend);
        }
        
        /**
         * 
         * @param string $strTime
         * @return string
         */
        public function timeCutSec($strTime) {
            $ex = explode(':', $strTime);
            return $ex[0].':'.$ex[1];
        }
        
        /**
         * 
         * @param type $time
         * @return boolean
         */
        public function testTime($time) {
            $timeEvt = strtotime($this->dateevent);            
            return (($timeEvt) == ($time)) || 
                   ($timeEvt <= $time && $this->cyclic ==1 && date('N', $timeEvt) == date('N', $time));
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
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('type_event_id',$this->type_event_id);
		$criteria->compare('dateevent',$this->dateevent);
		$criteria->compare('timestart',$this->timestart);
		$criteria->compare('timeend',$this->timeend);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	* @return CActiveDataProvider the data provider that can return the models
	*/
	public function searchBron($time = NULL) {
		if(is_null($time )) {
			$time  = mktime(0,0,0);
		}
		$this->type_event_id = 3;
		$dp = $this->search();
		$dp->criteria->addCondition('(dateevent >= '  .$time   .' AND dateevent <= '.($time + 3600 * 24).')'  );
		$dp->criteria->order = 'dateevent desc, timestart ';
		return $dp;
	}
	
	/**
	* @return CActiveDataProvider the data provider that can return the models
	*/
	public function searchMeeting($userId, $fromMe) {
		 
		$this->type_event_id = 4;
		$dp = $this->search();
		if($fromMe) {
			$dp->criteria->addCondition('(t.user_id = '.$userId.')');
		} else {
			$dp->criteria->addCondition('(t.id IN (SELECT event_id FROM {{EventInvited}} WHERE user_id = '.$userId.') )');
		}
		//$dp->criteria->addCondition('(dateevent >= '  .$time   .' AND dateevent <= '.($time + 3600 * 24).')'  );
		$dp->criteria->order = 'dateevent desc, timestart ';
		return $dp;
	}
	
	
        
        /**
         * 
         * @param type $start
         * @param type $end
         * @return \CActiveDataProvider
         */
        public function searchByDate($start = NULL, $end = NULL)
	{ 
            if(is_null($start)) {
                $start = mktime(0,0,0);
            }
            if(is_null($end)) {
                $end = $start + 3600 * 24 -1;
            }
           
            $criteria=new CDbCriteria;
            $criteria->order = 't.timestart';
            $criteria->with = array('typeEvent', 'place'); 
	    $criteria->condition = '(t.dateevent >= :mintime AND t.dateevent <= :maxtime) 
                OR (t.cyclic = 1 AND t.dateevent <= :mintime1 AND WEEKDAY(FROM_UNIXTIME(dateevent)) = WEEKDAY(FROM_UNIXTIME(:mintime2)) )';
            $criteria->params = array(
                ':mintime'=>$start,  
                ':maxtime'=>$end, 
                ':mintime1'=>$start, 
                ':mintime2'=>$start,
            );
	    return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
	    ));
        }
        
        /**
         * 
         * @return type
         */
        protected function afterFind() {
            if(is_null($this->dateevent)) {
                $this->dateevent = time();
            }
            $this->dateevent = date('d.m.Y', $this->dateevent);
            return parent::afterFind();
        }
        
        /**
         * 
         * @return type
         */
        protected function beforeSave() { 
            $this->dateevent = strtotime($this->dateevent);
            return parent::beforeSave();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
