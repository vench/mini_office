<?php

/**
 * This is the model class for table "VsChat".
 *
 * The followings are the available columns in table 'VsChat':
 * @property integer $id
 * @property integer $expire
 * @property integer $user_to
 * @property integer $user_from
 * @property integer $is_new
 * @property string $comment
 */
class VsChat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'VsChat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( 
			array('id, expire, user_to, user_from, is_new', 'numerical', 'integerOnly'=>true),
			array('comment,user_to', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, expire, user_to, user_from, is_new, comment', 'safe', 'on'=>'search'),
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
			'userTo'=> array(self::BELONGS_TO, 'User', 'user_to'),
			'userFrom'=> array(self::BELONGS_TO, 'User', 'user_from'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'expire' => 'Время',
			'user_to' => 'Кому',
			'user_from' => 'От кого',
			'is_new' => 'Новое',
			'comment' => 'Сообщение',
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
		$criteria->compare('expire',$this->expire);
		$criteria->compare('user_to',$this->user_to);
		$criteria->compare('user_from',$this->user_from);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
 
	
	/**
	*
	*/
	protected function beforeSave() {
		if($this->isNewRecord) {
			$this->expire = time();
			$this->is_new = 1;
		}
		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VsChat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
