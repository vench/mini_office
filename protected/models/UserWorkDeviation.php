<?php

/**
 * This is the model class for table "UserWorkDeviation".
 *
 * The followings are the available columns in table 'UserWorkDeviation':
 * @property integer $id
 * @property integer $user_id
 * @property integer $deviation_id
 * @property integer $datestart
 * @property integer $dateend
 *
 * The followings are the available model relations:
 * @property WorkDeviation $deviation
 * @property User $user
 */
class UserWorkDeviation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{UserWorkDeviation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, deviation_id, datestart, dateend,set_user_id', 'required'),
			array('user_id, deviation_id,  set_user_id', 'numerical', 'integerOnly'=>true),
			array('datestart', 'testOverLay'),
                        // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, deviation_id, datestart, set_user_id, dateend', 'safe', 'on'=>'search'),
		);
	}
        
        /**
         * 
         */
        public function testOverLay() {
                $model = self::model()->find('id <> :id AND user_id=:user_id AND datestart <= :dateend AND  dateend >= :datestart', array(
                    ':id'=>$this->isNewRecord ? 0 : $this->id,
                    ':user_id'=> $this->user_id,
                    ':dateend'=>  strtotime($this->dateend) ,
                    ':datestart'=> strtotime( $this->datestart),
                ));
               // var_dump($model,$this->datestart);
                if(!is_null($model)) {
                    $this->addError('datestart', 'В указанный период уже есть запись (c '.$model->datestartStr().' по '.$model->dateendStr().')');
                }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'deviation' => array(self::BELONGS_TO, 'WorkDeviation', 'deviation_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
                        'setuser' => array(self::BELONGS_TO, 'User', 'set_user_id'),
		);
	}
        
        /**
         * 
         * @return type
         */
        public function dateendStr() {
            return date('d.m.Y', $this->dateend);
        }
        
        /**
         * 
         * @return type
         */
        public function datestartStr() {
            return date('d.m.Y', $this->datestart);
        }

        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Пользователь',
			'deviation_id' => 'Тип отклонения',
			'datestart' => 'Дата начала',
			'dateend' => 'Дата окончания',
                        'set_user_id'=>'Кто поставил',
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
                $criteria->compare('set_user_id',$this->set_user_id);
		$criteria->compare('deviation_id',$this->deviation_id);
		$criteria->compare('datestart',$this->datestart);
		$criteria->compare('dateend',$this->dateend);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * 
         * @return type
         */
        protected function afterFind() {
           /* if(is_null($this->datestart)) {
                $this->datestart = time();
            }
            $this->datestart = date('d.m.Y', $this->datestart);
            if(is_null($this->dateend)) {
                $this->dateend = time();
            }
            $this->dateend = date('d.m.Y', $this->dateend);*/ 
            return parent::afterFind();
        }
        
        /**
         * 
         * @return type
         */
        protected function beforeSave() { 
            $this->datestart = strtotime($this->datestart);
            $this->dateend = strtotime($this->dateend);
            return parent::beforeSave();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserWorkDeviation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
