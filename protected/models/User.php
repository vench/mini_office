<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property integer $post_id
 * @property integer $subdivision_id
 * @property integer $datecreate
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $patronymic
 * @property string $surname
 * @property string $phone
 * @property integer $dateborn
 * @property integer $dateworkat
 * @property integer $dateworkto
 * @property string $company
 * @property string $company_site
 * @property integer $actual
 * @property integer $is_super_admin
 *
 * The followings are the available model relations:
 * @property RememberPass[] $rememberPasses
 * @property Post $post
 * @property Subdivision $subdivision
 */
class User extends CActiveRecord
{

         /**
         *
         * @var string 
         */
        public $passwordComf;
        /**
         *
         * @var string 
         */
        public $verifyCode;
        
        
        /**
         * 
         * @param type $password
         * @return types
         */
	public static function cryptPass($password) {
		$sold = 'dorwssap';
		return MD5($password.$sold );
	}
	
	/**
	*
	* @return array
	*/
	public static function getListTree() {
		$models = User::model()->findAll(array(
			'condition'=>'actual=1',
			'with'=>array('subdivision'),
			'select'=>'subdivision_id,id,name,patronymic,surname',
		));
		return CHtml::listData($models, 'id', 'FullName', 'FullSubdivision');
	}
        
        /**
        *
        * @return array 
        */
        public function behaviors() {
                return array_merge(parent::behaviors(),array(
                    'fileUploadCActiveRecordBehavior'=>array(
                        'class'=>'FileUploadCActiveRecordBehavior',
                        'fileFields'=>array('photo'), 
                        'extensions'=>array('jpg', 'png','gif','jpeg',),
                    ),
                ));
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{User}}';
	}
	
	 

	/**
	 * @return string 
	 */
	public function getFullName() {
		return $this->name .' '. $this->patronymic .' '. $this->surname;
	}
        
        /**
         * Полное пдразделение пользователя
         * @param type $join
         * @param type $asArray
         * @return string|array
         */
        public function getFullSubdivision($join = ' -> ', $asArray = false) {             
            return is_null($this->subdivision) ? NULL : $this->subdivision->getFullName($join, $asArray);
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, email, name, patronymic, surname, phone, dateborn', 'required'),
			array('post_id, subdivision_id, datecreate', 'numerical', 'integerOnly'=>true),
			array('login, password, email, phone', 'length', 'max'=>64),
			array('name, patronymic, surname', 'length', 'max'=>100),
			array('email', 'email', ),
			array('email,login', 'unique', ),
                        array('actual,is_super_admin', 'boolean', ),
                        array('dateworkat,dateworkto,photo', 'safe'),
                    
                        array('passwordComf', 'compare', 'compareAttribute'=>'password','on'=>array('register', 'insert', 'changePass'), 'message'=>'Пароли не совпадают.'),
                        array('verifyCode', 'captcha', 'on'=>'register'),
                    
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, post_id, subdivision_id, datecreate, login, password, email, name, patronymic, surname, phone, dateborn,  actual, is_super_admin', 'safe', 'on'=>'search'),
		);
	}

        /**
         * 
         * @return boolean
         */
	public function isSuperAdmin() {
		return $this->is_super_admin == 1;	
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rememberPasses' => array(self::HAS_MANY, 'RememberPass', 'user_id'),
                        'userWorkDeviations' => array(self::HAS_MANY, 'UserWorkDeviation', 'user_id'),
                    
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
			'subdivision' => array(self::BELONGS_TO, 'Subdivision', 'subdivision_id'),
                    
                        'events' => array(self::MANY_MANY, 'Event', 'EventInvited(event_id, user_id)'),
		);
	}
        
       
        /**
         * Список заданий на сегодня
         * @param type $times
         * @return array
         */
        public function getTaskList($time = NULL) { 
            $list = array();
            if(is_null($time)) {
               $time = mktime(0, 0, 0); 
            }
            
            foreach($this->events as $event) {
                if(!$event->testTime($time)) {
                    continue;
                }
                $timeStr =  $event->timestart != $event->timeend ? $event->timestartStr().' - '.$event->timeendStr() : $event->timestartStr();
                $list[] = array($timeStr, $event->typeEvent->name_msg.': '.$event->name, $event->getPrimaryKey());
            }
            return $list;
        }
                
        /**
         * 
         * @param type $time
         * @return null
         */
        public function getUserWorkDeviationByDate($time) { 
            foreach ($this->userWorkDeviations as $userWorkDeviation) {
                if($userWorkDeviation->datestart <= $time && $userWorkDeviation->dateend >= $time) {
                    return $userWorkDeviation;
                }
            }
            return NULL;
        }

        /**
	 * @return string.
	 */
	public function datecreateStr() {
		return date('d.m.Y', $this->datecreate);
	}
        
        /**
	 * @return string.
	 */
	public function datebornStr() {
		return date('d.m.Y', $this->dateborn);
	}
	
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => 'Должность',
			'subdivision_id' => 'Подразделение',
			'datecreate' => 'Дата создания',
			'login' => 'Логин',
			'password' => 'Пароль',
                        'passwordComf'=>'Подтвержение пароля',
			'email' => 'Email',
			'name' => 'Имя',
			'patronymic' => 'Отчество',
			'surname' => 'Фамилия',
			'phone' => 'Телефон',
			'dateborn' => 'Дата рождения', 
			'actual' => 'Активный',
			'is_super_admin' => 'Супер администратор',
                        'dateworkat'=>'Дата приема на работу',
                        'dateworkto'=>'Дата увольнения',
                        'photo'=>'Фото',
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
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('subdivision_id',$this->subdivision_id);
		$criteria->compare('datecreate',$this->datecreate);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('dateborn',$this->dateborn); 
		$criteria->compare('actual',$this->actual);
		$criteria->compare('is_super_admin',$this->is_super_admin);

                if($this->dateworkat > 0) { 
                   $criteria->addCondition('dateworkat > '.$this->dateworkat);
                }
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Получить список именинников
         * @param type $time
         * @return CActiveDataProvider Description
         */
        public function searchByHB($time = NULL) {
                if(is_null($time)) {
                    $time = time();
                }
		$criteria=new CDbCriteria;

		$criteria->condition = 'MONTH(FROM_UNIXTIME(dateborn)) = :month'; 
                $criteria->params = array(
                    ':month'=>date('m', $time),
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }

        /**
         * 
         * @return type
         */
        protected function beforeSave() {
            if($this->isNewRecord) {
                $this->datecreate = time();
                $this->password = self::cryptPass($this->password);
            }
            $this->dateborn = strtotime($this->dateborn);
            $this->dateworkat = strtotime($this->dateworkat);
            $this->dateworkto = strtotime($this->dateworkto);
            return parent::beforeSave();
        }
        
        /**
         * 
         * @return type
         */
        protected function afterFind() {
            if(is_null($this->dateborn)) {
                $this->dateborn = time();
            }
            $this->dateborn = date('d.m.Y', $this->dateborn);
            $this->dateworkat = date('d.m.Y', $this->dateworkat);
            $this->dateworkto = date('d.m.Y', $this->dateworkto);
            return parent::afterFind();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
