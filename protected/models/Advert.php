<?php

/**
 * This is the model class for table "Advert".
 *
 * The followings are the available columns in table 'Advert':
 * @property integer $id
 * @property integer $user_id
 * @property integer $dateadv
 * @property string $timeadv
 * @property string $advert
 * @property integer $important
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Advert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Advert}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, dateadv, timeadv, advert', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
                        array('important', 'boolean'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, dateadv, timeadv, advert, important', 'safe', 'on'=>'search'),
		);
	}
        
        /**
         * 
         * @return type
         */
        public function dateadvStr() {
            return date('d.m.Y', $this->dateadv);
        }
        
        /**
         * 
         * @return string
         */
        public function timeadvStr() {
            return $this->timeCutSec($this->timeadv);
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'user_id' => 'Создатель',
			'dateadv' => 'Дата',
			'timeadv' => 'Время',
			'advert' => 'Описание',
			'important' => 'Важное',
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
		$criteria->compare('dateadv',$this->dateadv);
		$criteria->compare('timeadv',$this->timeadv,true);
		$criteria->compare('advert',$this->advert,true);
		$criteria->compare('important',$this->important);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * 
         * @return type
         */
        protected function afterFind() {
            if(is_null($this->dateadv)) {
                $this->dateadv = time();
            }
            $this->dateadv = date('d.m.Y', $this->dateadv);
            return parent::afterFind();
        }
        
        /**
         * 
         * @return type
         */
        protected function beforeSave() { 
            $this->dateadv = strtotime($this->dateadv);
            return parent::beforeSave();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Advert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
